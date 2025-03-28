<?php

namespace App\Http\Controllers;

use App\Models\Marketplace;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome() 
    {
        $products = Product::inRandomOrder()->limit(9)->get();
        $marketplaces = Marketplace::inRandomOrder()->limit(9)->get();

        return view('welcome', compact('products', 'marketplaces'));
    }
}
