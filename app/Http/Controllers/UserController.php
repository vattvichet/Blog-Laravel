<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingField = $request->validate([
            "name" => ["required", "min:3", "max:10"],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "password" => ["required", "min:8", "max:50"],

        ]);
        $incomingField['password'] = bcrypt('123456');
        $user = User::create($incomingField);
        auth()->login($user);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $incomingField = $request->validate([
            "loggedInEmail" => ["required", "email"],
            "loggedInPassword" => ["required", "min:8", "max:50"],
        ]);
        if (auth()->attempt(['email' => $incomingField['loggedInEmail'], 'password' => $incomingField['loggedInPassword']])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }
    public function logOut()
    {
        auth()->logout();
        return redirect('/');
    }
}
