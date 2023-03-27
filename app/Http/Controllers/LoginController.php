<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login()
    {

        $user = User::where('email',request('email'))->first();

        if($user && Hash::check(request('password'), $user->password)){
            $abilities = $this->resolveAbilities($user, request('device'));
            $token = $user->createToken('login',
            [
                'establishment:show',
                'orders:create',
            ]);
            return response([
                'token' => $token->plainTextToken,
            ]);
        }

        return response([
            'message' => 'Credencial incorrecta',
        ]);
    }

    public function resolveAbilities($user, $device){

    }
}
