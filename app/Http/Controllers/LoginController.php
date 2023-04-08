<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Services\AbilitiesResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login()
    {
        $user = User::where('email',request('email'))->first();

        if($user && Hash::check(request('password'), $user->password)){
            $abilities = AbilitiesResolver::resolve($user, request('device'));
            $token = $user->createToken('login', $abilities);
            return response([
                'token' => $token->plainTextToken,
            ]);
        }

        return response([
            'message' => 'Credenciales incorrecta',
        ]);
    }


}
