<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $user            = auth()->user();
        $user->api_token = Str::random(60);
        $user->save();

        return response()->json($user);
    }
}