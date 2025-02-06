<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $company = Company::latest()->first();

        return view('pages.about', compact('company'));
    }
}
