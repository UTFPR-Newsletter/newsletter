<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\dao\GenericCtrl;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Subscriber;

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

        // Gera um token único para o login
        $token = Str::random(6);
        
        // Atualiza o assinante com o token
        $user->usr_login_token = $token;
        $user->usr_login_token_expires_at = now()->addHours(24); // Token válido por 24 horas
        $user->save();

        Mail::raw('Olá! Este é um teste enviado pelo Laravel.', function ($message) use ($user, $token) {
            $message
                ->to("fe.hatunaqueton@gmail.com")
                ->subject('🚀 Código de acesso: ' . $token);
        });

        return response()->json([
            "status" => true,
            "message" => "Foi enviado um email com um código para seu e-mail!"
        ], 200);
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
}
