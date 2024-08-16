<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class AuthController extends Controller
{
    /**
     * Login user and generate token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        // if (Auth::attempt($validatedData)){
        //     $request->session()->regenerate();
        //     return redirect()->route('admin.dashboard');
        // }

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return redirect()->back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }

        if ($user->etat == '0') {
            return redirect()->back()->withErrors(['account' => 'Your account is deactivated.']);
        }

        // $token = $user->createToken('auth_token', [$user->role])->plainTextToken;
        
        // // Set token as a cookie
        // $cookie = cookie('auth_token', $token, 60*24); // Token is valid for 24 hours

        // // Store the token and user role in the session
        // $request->session()->put('auth_token', $token);
        // $request->session()->put('user_role', $user->role);
        if (Auth::attempt($validatedData)){
        $request->session()->regenerate();

        // Redirect based on user role
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');//->withCookie($cookie);
            case 'finance':
                return redirect()->route('finance.dashboard');//->withCookie($cookie);
            case 'infra':
                return redirect()->route('infra.dashboard');//->withCookie($cookie);
            case 'facturation':
                return redirect()->route('facturation.dashboard');//->withCookie($cookie);
            default:
                return redirect()->route('login')->withErrors(['role' => 'Unknown role.']);
        }
    }
    }

    /**
     * Logout user (revoke the token)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function logout(Request $request)
    {
        //$request->user()->currentAccessToken()->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Remove the auth token cookie
        //$cookie = Cookie::forget('auth_token');

        return redirect('/login');//->withCookie($cookie);
    }
}
