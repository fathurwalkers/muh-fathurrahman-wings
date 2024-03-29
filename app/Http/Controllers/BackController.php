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

class BackController extends Controller
{
    public function index()
    {
        $product = Product::all()->count();
        $transaction = Transactiondetail::all()->count();
        $user = Login::all()->count();
        return view('dashboard.index', [
            'product' => $product,
            'transaction' => $transaction,
            'user' => $user,
        ]);
    }

    public function daftar_akun()
    {
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        $akun = Login::where('login_level', '!=', 'admin')->get();
        $siswa = Siswa::all();
        return view('dashboard.daftar-akun', [
            'users' => $users,
            'akun' => $akun,
        ]);
    }

    public function product_list()
    {
        $product = Product::all();
        return view('dashboard.product-list', [
            'product' => $product
        ]);
    }

    public function transaction_list()
    {
        $transaction = Transactiondetail::all();
        return view('dashboard.transaction-list', [
            'transaction' => $transaction
        ]);
    }

    public function hapus_akun(Request $request)
    {
        $akun_id = $request->hapus_id;
        $akun = Data::find($akun_id);
        $login = Login::find($akun->login_id);
        $alert = "Berhasil menghapus Data Akun : " . $akun->data_nama;
        $login->forceDelete();
        return redirect()->route('data-akun')->with('status', $alert);
    }

    public function login_admin()
    {
        $users = session('data_login');
        if ($users == null) {
            return view('login-admin');
        } else {
            if ($users->login_level == "user") {
                return redirect()->route('home')->with('status', 'Maaf anda tidak punya akses ke halaman ini.');
            }
            return redirect()->route('dashboard')->with('status', 'Maaf anda tidak punya akses ke halaman ini.');

        }
    }

    public function login_client()
    {
        $users = session('data_login');
        if ($users == null) {
            return view('login-client');
        } else {
            if ($users->login_level == "admin") {
                return redirect()->route('dashboard')->with('status', 'Maaf anda tidak punya akses ke halaman ini.');
            }
            return redirect()->route('home')->with('status', 'Maaf anda tidak punya akses ke halaman ini.');
        }
    }

    public function logout(Request $request)
    {
        // $cek_logout_request = $request->logoutrequest;
        $session_users = session('data_login');
        $users = Login::find($session_users->id);
        switch ($users->login_level) {
            case 'admin':
                $users = session('data_login');
                $request->session()->forget(['data_login']);
                $request->session()->flush();
                return redirect()->route('login-admin')->with('status', 'Anda telah logout!');
                break;
            case 'user':
                $users = session('data_login');
                $request->session()->forget(['data_login']);
                $request->session()->flush();
                return redirect()->route('login-client')->with('status', 'Anda telah logout!');
                break;
        }
    }

    public function post_login(Request $request)
    {
        $cek_request = $request->cekrequest;
        $cari_user = Login::where('login_username', $request->login_username)->first();
        if ($cari_user == null) {
            return back()->with('status', 'Maaf username atau password salah!')->withInput();
        }
        $data_login = Login::where('login_username', $request->login_username)->firstOrFail();
        switch ($data_login->login_level) {
            case 'admin':
                if ($cek_request == "user") {
                    return redirect()->route('login-client')->with('status', 'Maaf anda tidak dapat memasukkan akun Admin pada halaman User!');
                }
                $cek_password = Hash::check($request->login_password, $data_login->login_password);
                if ($data_login) {
                    if ($cek_password) {
                        $users = session(['data_login' => $data_login]);
                        return redirect()->route('dashboard')->with('status', 'Berhasil Login!');
                    }
                }
                break;
            case 'user':
                if ($cek_request == "admin") {
                    return redirect()->route('login-admin')->with('status', 'Maaf anda tidak dapat memasukkan akun user pada halaman administrator!');
                }
                $cek_password = Hash::check($request->login_password, $data_login->login_password);
                if ($data_login) {
                    if ($cek_password) {
                        $users = session(['data_login' => $data_login]);
                        return redirect()->route('home')->with('status', 'Berhasil Login!');
                    }
                }
                break;
        }
        return back()->with('status', 'Maaf username atau password salah!')->withInput();
    }

    public function post_register(Request $request)
    {
        $validatedLogin                 = $request->validate([
            'login_nama'                => 'required',
            'login_username'            => 'required',
            'login_password'            => 'required',
            'login_email'               => 'required',
            'login_telepon'             => 'required',
            'login_alamat'              => 'required'
        ]);
        if ($validatedLogin["login_password"] !== $request->login_password2) {
            return back()->with('status', 'Password harus sama.')->withInput();
        }
        $hashPassword                   = Hash::make($validatedLogin["login_password"], [
            'rounds' => 12,
        ]);
        $token_raw                      = Str::random(16);
        $token                          = Hash::make($token_raw, [
            'rounds' => 12,
        ]);
        $level                          = "user";
        $login_status                   = "verified";
        $login_data                     = new Login;
        $save_login                     = $login_data->create([
            'login_nama'                => $validatedLogin["login_nama"],
            'login_username'            => $validatedLogin["login_username"],
            'login_password'            => $hashPassword,
            'login_email'               => $validatedLogin["login_email"],
            'login_telepon'             => $validatedLogin["login_telepon"],
            'login_alamat'              => $validatedLogin["login_alamat"],
            'login_token'               => $token,
            'login_level'               => $level,
            'login_status'              => $login_status,
            'created_at'                => now(),
            'updated_at'                => now()
        ]);
        $save_login->save();
        return redirect()->route('login')->with('status', 'Berhasil melakukan registrasi!');
    }
}
