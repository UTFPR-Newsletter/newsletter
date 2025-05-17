<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\dao\GenericCtrl;
use Illuminate\Support\Str;
class SubscriberController extends Controller
{
    /**
     * Recebe o POST com sub_email para criar um registro de assinante.
     */
    public function store(Request $request) {
        $data = $request->validate(array(
            "sub_email" => "required|string|max:255",
        ));

        $subscriber = new GenericCtrl("Subscriber");
        $subscriberExists = $subscriber->getObjectByField("sub_email", $data["sub_email"]);

        if ($subscriberExists) {
            return redirect()->back()->with("error", "Você já está assinado!");
        }

        $subscriber->save($data);

        return redirect()->back()
            ->with('toasts', [
                ['id' => (string) Str::uuid(), 'type' => 'success', 'message' => 'Cadastro OK!'],
            ]);
    }
}
