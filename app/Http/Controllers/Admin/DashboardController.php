<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Testimony;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalProduct = Product::count();
        $totalTestimony = Testimony::count();

        return view('admin.pages.dashboard.index', compact('totalCategory', 'totalProduct', 'totalTestimony'));
    }
}
