<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products = [
            ['id' => 1, 'image' => 'images/products/test.jpg', 'name' => 'Triangle Sunglasses', 'price' => 50000],
            ['id' => 2, 'image' => 'images/products/test.jpg', 'name' => 'Versatile Sunglasses', 'price' => 68000],
            ['id' => 3, 'image' => 'images/products/test.jpg', 'name' => 'Pink Thick Sunglasses', 'price' => 100000],
            ['id' => 3, 'image' => 'images/products/test.jpg', 'name' => 'Tan Tint Sunglasses', 'price' => 100000],
            ['id' => 3, 'image' => 'images/products/test.jpg', 'name' => 'White Triangle Sunglasses', 'price' => 100000],
            ['id' => 3, 'image' => 'images/products/test.jpg', 'name' => 'Black Frame Sunglasses', 'price' => 100000],
        ];

        return view('pages.index', compact('products'));
    }
}
