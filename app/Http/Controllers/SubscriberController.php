<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\dao\GenericCtrl;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Subscriber;
use App\Mail\AccessCodeMail;
use App\Mail\MagicLinkMail;
use App\Http\Controllers\Utils\TripleDES;

use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function validatePasswordLogin($email, $password) {
        try {
            $userCtrl = new GenericCtrl("User");
            
            // Get user by email directly
            $user = $userCtrl->getObjectByField("usr_email", $email);

            if(!$user instanceof User) {
                return [
                    "status" => false,
                    "message" => "Usuário não encontrado!"
                ];
            }

            if($user->usr_active !== 1) {
                return [
                    "status" => false,
                    "message" => "Conta inativa!"
                ];
            }

            // Se o usuário não tem senha cadastrada
            if(is_null($user->usr_password)) {
                return [
                    "status" => false,
                    "message" => "Usuário não possui senha cadastrada. Use o login simplificado."
                ];
            }

            // Descriptografa a senha do banco para comparar
            $tripleDES = new TripleDES();
            $decryptedPassword = $tripleDES->decrypt($user->usr_password);

            if($decryptedPassword !== $password) {
                return [
                    "status" => false,
                    "message" => "Senha incorreta!"
                ];
            }

            Auth::login($user);

            return [
                "status" => true,
                "message" => "Login realizado com sucesso!",
                "level" => $user->usr_level,
                "user" => $user
            ];
        } catch (\Exception $e) {
            return [
                "status" => false,
                "message" => "Erro interno. Tente novamente."
            ];
        }
    }

    public function sendSimpleLoginEmail($email) {
        try {
            $userCtrl = new GenericCtrl("User");

            $user = $userCtrl->getObjectByField("usr_email", $email);
            
            if(!$user instanceof User) {
                return [
                    "status" => false,
                    "message" => "Usuário não encontrado!"
                ];
            }

            // Se o usuário tem login mágico ativo
            if ($user->usr_has_magic_link) {
                // Cria o payload com o ID do usuário e timestamp
                $payload = json_encode([
                    'user_id' => $user->usr_id,
                    'created_at' => now()->format('Y-m-d H:i:s') // Token válido por 2 dias
                ]);

                // Criptografa o payload
                $tripleDES = new TripleDES();
                $token = $tripleDES->encrypt($payload);

                // Gera a URL mágica
                $magicUrl = route('magic.login.auth', ['token' => $token]);

                $userCtrl->update($user->usr_id, [
                    "usr_magic_link_url" => $magicUrl
                ]);

                // Envia o email com a URL mágica
                Mail::to($user->usr_email)
                    ->send(new MagicLinkMail($user, $magicUrl));

                return [
                    "status" => true,
                    "message" => "Foi enviado um link mágico para seu e-mail!"
                ];
            }

            // Caso contrário, usa o login por código
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

            return [
                "status" => true,
                "message" => "Foi enviado um email com um código para seu e-mail!"
            ];
        } catch (\Exception $e) {
            return [
                "status" => false,
                "message" => "Erro interno. Tente novamente." . $e->getTraceAsString()
            ];
        }
    }

    public function validateSimpleLogin($email, $token) {
        try {
            $userCtrl = new GenericCtrl("User");

            $user = $userCtrl->getObjectByField("usr_email", $email);
            
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

    public function store($email) {
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
