<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\Models\Login;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function product_list()
    {
        $product = Product::all();
        return view('home.product-list', [
            'product' => $product
        ]);
    }

    public function checkout_product(Request $request)
    {
        //
    }
}
