<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        return response()->json([
            "user" => $user,
            "token" => $token
        ]);
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ]);
        }

        if ( !auth()->attempt($request->toArray()) ) {
            return response([
                'errors' => 'Credenciales incorrectas. Intenta nuevamente.'
            ]);
        }

        // if ( !auth()->user()->email_verified_at ) {
        //     return response([
        //         'errors' => 'Necesita verificar su correo.'
        //     ]);
        // }
        
        $token = auth()->user()->createToken('Laravel Password Grant Client')->accessToken;
        return response()->json([
            "user" => auth()->user(),
            "token" => $token
        ]);
    }
}
