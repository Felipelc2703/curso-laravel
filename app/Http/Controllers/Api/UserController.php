<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,

        ];

        if(Auth::attempt($credentials))
        {
            $token = Auth::user()->createToken('MyAppToken')->plainTextToken;

            session()->put('token',$token);

            return response()->json([
                'isLogIn' => true,
                'user' => auth()->user(),
                'token' => $token,
            ]);       
        }

        return response()->json("Usuario y/o contraseña invalido",422);

        // $user->tokens()->delete();
    }

    public function checkToken()
    {
        try{
            
            [$id,$token] = explode('|',request('token'));
            $tokenHas = hash('sha256',$token);
            $tokenModel = PersonalAccessToken::where('token',$tokenHas)->first();
            // dd($tokenModel->tokenable);
            if($tokenModel)
            {
                Auth::login($tokenModel->tokenable);
                return response()->json([
                    'isLogIn' => true,
                    'user' => auth()->user(),
                    'token' => request('token'),
                ]); 
            } 

        }catch(\Throwable) {

        }
        return response()->json("Usuario invalido",422);
    }

    public function logOut()
    {

        // dd(request('token'));
        [$id,$token] = explode('|',request('token'));
        if(Auth::user())
        {
            Auth::user()->tokens()->where('id',$id)->delete();
        } else {
            PersonalAccessToken::where('id',$id)->delete();
        }
        session()->flush();

        return response()->json("Cierre de sesion");
    }
}
