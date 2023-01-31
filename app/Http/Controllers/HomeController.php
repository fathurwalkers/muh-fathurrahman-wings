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
use App\Models\Transactiondetail;
use App\Models\Transactionheader;

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
        $faker                  = Faker::create('id_ID');
        $session_users = session('data_login');

        $users = Login::find($session_users->id);

        $id_product = $request->id_product;

        $explode_id_product = explode(",", $id_product);

        $id_product_filtered = array_filter($explode_id_product);
        $array_product = [];
        foreach ($id_product_filtered as $product_id) {
            $get_product = Product::find($product_id);
            $product = array_push($array_product, $get_product);
            $transaction_header = new Transactionheader;
            $save_transaction_header = $transaction_header->create([
                'document_code' => strtoupper(Str::random(3)),
                'document_number' => $faker->randomNumber(3),
                'total' => count($array_product),
                'date' => now(),
                'user_id' => $users->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $save_transaction_header->save();
        }
        return view('home.checkout-product', [
            'product' => $array_product,
            'users' => $users,
        ]);
    }

    public function proses_checkout(Request $request, $product)
    {
        $faker                  = Faker::create('id_ID');
        $explode_id_product = explode(",", $product);
        foreach ($explode_id_product as $product_id) {
            $get_product = Product::find($product_id);

            $transaction_detail = new Transactiondetail;

            $save_transaction_detail = $transaction_detail->create([
                'document_code' => strtoupper(Str::random(3)),
                'document_number' => $faker->randomNumber(3),
                'product_code' => strtoupper(Str::random(9)),
                'price' => $get_product->price,
                'quantity' => 1,
                'unit' => "PCS",
                'sub_total' => $get_product->price,
                'currency' => "IDR",
                'product_id' => $get_product->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $save_transaction_detail->save();
        }
        return redirect()->route('home')->with('status', 'Produk telah berhasil di beli. ');
    }
}
