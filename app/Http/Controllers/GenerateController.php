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
}
