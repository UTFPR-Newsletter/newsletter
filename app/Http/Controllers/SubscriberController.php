<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\dao\GenericCtrl;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Subscriber;
use App\Mail\AccessCodeMail;

use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function sendSimpleLoginEmail(Request $request) {
        $data = $request->validate(array(
            "sub_email" => "required|string|max:255",
        ));

        $subscriberCtrl = new GenericCtrl("Subscriber");
        $userCtrl = new GenericCtrl("User");

        $subscriber = $subscriberCtrl->getObjectByField("sub_email", $data["sub_email"]);
        $user = $userCtrl->getObjectByFields(
            ["usr_level", "usr_active", "represented_agent_id"],
            [User::LEVEL_SUBSCRIBER, 1, $subscriber->sub_id]
        );

        if (!$subscriber instanceof Subscriber) {
            return response()->json([
                "status" => false,
                "message" => "Assinante não encontrado!"
            ], 404);
        }

        if(!$user instanceof User) {
            return response()->json([
                "status" => false,
                "message" => "Usuário não encontrado!"
            ], 404);
        }

        if(!$user->usr_login_token_expires_at > now() || is_null($user->usr_login_token)) {
            // Gera um token único para o login
            $token = Str::random(6);
            
            // Atualiza o assinante com o token
            $user->usr_login_token = $token;
            $user->usr_login_token_expires_at = now()->addHours(24); // Token válido por 24 horas
            $user->save();
        } else {
            $token = $user->usr_login_token;
        }

        Mail::to($user->usr_email)
            ->send(new AccessCodeMail($user, $token));

        return response()->json([
            "status" => true,
            "message" => "Foi enviado um email com um código para seu e-mail!"
        ], 200);
    }

    public function sendSimpleLoginEmailForLivewire($email) {
        try {
            $subscriberCtrl = new GenericCtrl("Subscriber");
            $userCtrl = new GenericCtrl("User");

            $subscriber = $subscriberCtrl->getObjectByField("sub_email", $email);
            
            if (!$subscriber instanceof Subscriber) {
                return [
                    "status" => false,
                    "message" => "Assinante não encontrado!"
                ];
            }

            $user = $userCtrl->getObjectByFields(
                ["usr_level", "usr_active", "represented_agent_id"],
                [User::LEVEL_SUBSCRIBER, 1, $subscriber->sub_id]
            );

            if(!$user instanceof User) {
                return [
                    "status" => false,
                    "message" => "Usuário não encontrado!"
                ];
            }

            if(!$user->usr_login_token_expires_at > now() || is_null($user->usr_login_token)) {
                // Gera um token único para o login
                $token = Str::random(6);
                
                // Atualiza o assinante com o token
                $user->usr_login_token = $token;
                $user->usr_login_token_expires_at = now()->addHours(24); // Token válido por 24 horas
                $user->save();
            } else {
                $token = $user->usr_login_token;
            }

            Mail::to("fe.hatunaqueton@gmail.com")
                ->send(new AccessCodeMail($user, $token));

            return [
                "status" => true,
                "message" => "Foi enviado um email com um código para seu e-mail!"
            ];
        } catch (\Exception $e) {
            return [
                "status" => false,
                "message" => "Erro interno. Tente novamente."
            ];
        }
    }

    public function validateSimpleLogin(Request $request) {
        $data = $request->validate(array(
            "sub_email" => "required|string|max:255",
            "token" => "required|string|max:6",
        ));

        $subscriberCtrl = new GenericCtrl("Subscriber");
        $userCtrl = new GenericCtrl("User");

        $subscriber = $subscriberCtrl->getObjectByField("sub_email", $data["sub_email"]);
        $user = $userCtrl->getObjectByFields(
            ["usr_level", "usr_active", "represented_agent_id"],
            [User::LEVEL_SUBSCRIBER, 1, $subscriber->sub_id]
        );

        if(!$user instanceof User) {
            return response()->json([
                "status" => false,
                "message" => "Usuário não encontrado!"
            ], 404);
        }

        if($user->usr_login_token_expires_at < now()) {
            return response()->json([
                "status" => false,
                "message" => "Código de acesso expirado!"
            ], 400);
        }

        if($user->usr_login_token != $data["token"]) {
            return response()->json([
                "status" => false,
                "message" => "Código de acesso inválido!"
            ], 400);
        }

        $user->usr_login_token = null;
        $user->usr_login_token_expires_at = null;
        $user->save();

        Auth::login($user);

        return response()->json([
            "status" => true,
            "message" => "Código de acesso validado com sucesso!"
        ], 200);
    }

    public function validateSimpleLoginForLivewire($email, $token) {
        try {
            $subscriberCtrl = new GenericCtrl("Subscriber");
            $userCtrl = new GenericCtrl("User");

            $subscriber = $subscriberCtrl->getObjectByField("sub_email", $email);
            
            if (!$subscriber instanceof Subscriber) {
                return [
                    "status" => false,
                    "message" => "Assinante não encontrado!"
                ];
            }

            $user = $userCtrl->getObjectByFields(
                ["usr_level", "usr_active", "represented_agent_id"],
                [User::LEVEL_SUBSCRIBER, 1, $subscriber->sub_id]
            );

            if(!$user instanceof User) {
                return [
                    "status" => false,
                    "message" => "Usuário não encontrado!"
                ];
            }

            if($user->usr_login_token_expires_at < now()) {
                return [
                    "status" => false,
                    "message" => "Código de acesso expirado!"
                ];
            }

            if($user->usr_login_token != $token) {
                return [
                    "status" => false,
                    "message" => "Código de acesso inválido!"
                ];
            }

            $user->usr_login_token = null;
            $user->usr_login_token_expires_at = null;
            $user->save();

            Auth::login($user);

            return [
                "status" => true,
                "message" => "Login realizado com sucesso!",
                "user" => $user
            ];
        } catch (\Exception $e) {
            return [
                "status" => false,
                "message" => "Erro interno. Tente novamente."
            ];
        }
    }

    /**
     * Recebe o POST com sub_email para criar um registro de assinante.
     */
    public function store(Request $request) {
        $data = $request->validate(array(
            "sub_email" => "required|string|max:255",
        ));

        $subscriberCtrl = new GenericCtrl("Subscriber");
        $userCtrl = new GenericCtrl("User");

        // Verifica se o assinante já existe
        $subscriberExists = $subscriberCtrl->getObjectByField("sub_email", $data["sub_email"]);

        if ($subscriberExists instanceof Subscriber) {
            return response()->json([
                "status" => false,
                "message" => "Você já está assinado!"
            ], 409);
        }

        $subscriber = $subscriberCtrl->save($data);
        $userCtrl->save([
            "usr_email" => $data["sub_email"],
            "usr_level" => User::LEVEL_SUBSCRIBER,
            "usr_active" => 1,
            "represented_agent_id" => $subscriber->sub_id,
        ]);

        return response()->json([
            "status" => true,
            "message" => "Assinatura enviada com sucesso!"
        ], 201);
    }

    public function storeForLivewire($email) {
        try {
            $subscriberCtrl = new GenericCtrl("Subscriber");
            $userCtrl = new GenericCtrl("User");

            // Verifica se o assinante já existe
            $subscriberExists = $subscriberCtrl->getObjectByField("sub_email", $email);

            if ($subscriberExists instanceof Subscriber) {
                return [
                    "status" => false,
                    "message" => "Você já está assinado!"
                ];
            }

            $subscriber = $subscriberCtrl->save(['sub_email' => $email]);
            $userCtrl->save([
                "usr_email" => $email,
                "usr_level" => User::LEVEL_SUBSCRIBER,
                "usr_active" => 1,
                "represented_agent_id" => $subscriber->sub_id,
            ]);

            return [
                "status" => true,
                "message" => "Assinatura realizada com sucesso!"
            ];
        } catch (\Exception $e) {
            return [
                "status" => false,
                "message" => "Erro ao processar assinatura. Tente novamente."
            ];
        }
    }
}
