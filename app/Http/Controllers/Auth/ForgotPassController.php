<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgotPassController extends Controller
{
    public function forgot()
    {
        return view('pages.auth.forgot');
    }
}
