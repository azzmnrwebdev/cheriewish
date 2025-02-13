<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function loginAct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email.',
            'password.required' => 'Password is required.',
            'captcha.required' => 'Captcha is required.',
        ]);

        $errors = $validator->errors();

        $loginFailed = !Auth::attempt($request->only('email', 'password'));
        $captchaFailed = !Captcha::check($request->input('captcha') ?? '');

        if ($loginFailed) {
            $errors->add('email', 'These credentials do not match our records.');
        }

        if ($captchaFailed) {
            $errors->add('captcha', 'Invalid captcha.');
        }

        if ($errors->any()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $user = Auth::user();

        if (is_null($user->email_verified_at)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->back()->with('error', 'Your email address is not verified.<br />Please check your inbox.');
        }

        $request->session()->regenerate();

        return redirect(route('dashboard'));
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
}
