<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    protected function register(Request $request)
    {
        $fields = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name'      => $fields['name'],
            'email'     => $fields['email'],
            'password'  => bcrypt($fields['password']),
            'api_token' => Str::random(60),
        ]);

        event(new Registered($user));

        return response()->noContent();
    }
}