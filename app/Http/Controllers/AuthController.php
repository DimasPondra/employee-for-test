<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('pages.auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (
            !$user ||
            !Hash::check($request->password, $user->password)
        ) {
            return back()->withErrors([
                'auth' => 'Email or password did not match.'
            ]);
        }

        Auth::login($user, $remember = true);

        if ($user->role == User::ROLE_ADMIN) {
            return redirect()->route('admin.dashboard');
        } else if ($user->role == User::ROLE_USER) {
            return redirect()->route('employee.dashboard');
        } else {
            return view('welcome');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-page');
    }
}
