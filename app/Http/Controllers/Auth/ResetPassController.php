<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetPassController extends Controller
{
    public function reset()
    {
        return view('pages.auth.reset');
    }
}
