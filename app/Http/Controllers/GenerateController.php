<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\Models\Login;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Matapelajaran;
use App\Models\Nilai;
use App\Models\Product;
use App\Models\Semester;
use Illuminate\Support\Carbon;

class GenerateController extends Controller
{
    public function generate_user()
    {
        $faker                  = Faker::create('id_ID');

        for ($i=0; $i < 10; $i++) {

            $nama = $faker->name();
            $login = new Login;
            $foto = "default-user.png";
            $telepon = $faker->phoneNumber();
            $status = "AKTIF";

            // GENERATE DATA LOGIN
            $token = Str::random(16);
            $level = "user";
            $hashPassword = Hash::make('12345', [
                'rounds' => 12,
            ]);
            $hashToken = Hash::make($token, [
                'rounds' => 12,
            ]);
            $username = strtolower(Str::random(10));
            $save_login = $login->create([
                'login_nama'        => $nama,
                'login_username'    => $username,
                'login_password'    => $hashPassword,
                'login_email'       => $faker->email(),
                'login_telepon'     => $telepon,
                'login_token'       => $hashToken,
                'login_level'       => $level,
                'login_status'      => "verified",
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
            $save_login->save();
        }
        // return redirect()->route('daftar-siswa')->with('status', 'Berhasil melakukan Auto Generate Data Siswa.');
    }

    public function generate_product()
    {
        $faker                  = Faker::create('id_ID');
        $array_nama_product = [
            'Gulaku',
            'Raja Gula',
            'Gula Semut Aren',
            'Kopiko',
            'Aqua Botol',
            'Coca Cola',
            'Sprite',
            'Kopi Kapal Api',
            'Kopi ABC',
            'Susu Kental Manis',
        ];

        foreach ($array_nama_product as $item) {

            $product = new Product;
            $array_price = [4, 5, 6];
            $random_price = Arr::random($array_price);

            $array_discount = [10, 20, 40, 50, 60];
            $random_discount = Arr::random($array_discount);

            $random_cm1 = $faker->randomNumber(2);
            $random_cm2 = $faker->randomNumber(2);

            $price = $faker->randomNumber($random_price);
            $discount = $random_discount;
            $product_code = Str::random(9);
            $currency = "IDR";
            $dimension = $random_cm1 . " cm x " . $random_cm2 . " cm";
            $unit = "PCS";

            $save_product = $product->create([
                'product_code' => strtoupper($product_code),
                'product_name' => $item,
                'price' => intval($price),
                'currency' => $currency,
                'discount' => intval($discount),
                'dimension' => $dimension,
                'unit' => $unit,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $save_product->save();
        }
    }
}
