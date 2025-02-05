<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function signIn(LoginFormRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route("index"));
        }

        return back()->withErrors([
            'credentials' => 'Identifiants incorrect'
        ]);
    }


    public function register()
    {
        return view("auth.register");
    }

    public function signUp(RegisterFormRequest $request)
    {
        $validatedRequest = $request->validated();

        // Hash the password before saving it to the database
        $validatedRequest["password"] = Hash::make($validatedRequest["password"]);
        // We don't need the password_confirmation field in the database
        unset($validatedRequest["password_confirmation"]);

        // Create a new user
        $user = User::create($validatedRequest);

        // Log the user in
        Auth::login($user);

        return redirect(route("index"));
    }


    public function logout()
    {
        Auth::logout();

        return to_route("login")->with('success', "Déconnecté avec succès");
    }
}
