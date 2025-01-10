<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $search = $request->input('search');
        $price = $request->input('price');
        $selectedCategories = $request->input('categories', []);

        $categories = Category::all();

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        if ($price === 'low') {
            $query->orderByRaw('CAST(price AS NUMERIC) ASC');
        } elseif ($price === 'high') {
            $query->orderByRaw('CAST(price AS NUMERIC) DESC');
        }

        if (!is_array($selectedCategories)) {
            $selectedCategories = explode(',', $selectedCategories);
        }

        if ($selectedCategories && is_array($selectedCategories)) {
            $query->whereHas('categories', function ($query) use ($selectedCategories) {
                $query->whereIn('categories.id', $selectedCategories);
            });
        }

        $products = $query->with(['thumbnail', 'imagesWithoutThumbnail', 'categories'])
            ->orderByDesc('updated_at')
            ->latest('created_at')
            ->get();

        return view('pages.shop', compact('products', 'search', 'categories', 'selectedCategories'));
    }

    public function show($slug)
    {
        $product = Product::with(['thumbnail', 'imagesWithoutThumbnail', 'categories'])
            ->where('slug', $slug)->first();

        $otherProducts = Product::with(['thumbnail', 'imagesWithoutThumbnail', 'categories'])
            ->where('slug', '!=', $slug)
            ->get();

        return view('pages.show-product', compact('product', 'otherProducts'));
    }
}
