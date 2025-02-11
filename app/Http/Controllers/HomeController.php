<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Testimony;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $about = Company::latest()->select('short_description')->first();
        $reviews = Testimony::where('stars', '>=', 4)->orderBy('updated_at', 'desc')->get();
        $products = Product::with(['thumbnail', 'categories'])->orderBy('updated_at', 'desc')->get();

        $reviews_count = $reviews->count();
        $products_count = $products->count();

        return view('pages.index', compact('products', 'about', 'reviews', 'products_count', 'reviews_count'));
    }
}
