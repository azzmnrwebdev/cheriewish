<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Company;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::latest()->first();
        $company = Company::latest()->first();

        return view('pages.about', compact('about', 'company'));
    }
}
