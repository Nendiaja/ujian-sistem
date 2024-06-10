<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Periksa apakah pengguna sudah login dan memiliki peran admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard.index');
        }
        else if (Auth::check() && Auth::user()->role === 'user') {
            return redirect()->route('user.dashboard.index');
        }
        else if (Auth::check() && Auth::user()->role === 'visitor') {
            return redirect()->route('visitor.dashboard.index');
        }


        $userResourceCollection = User::where('role', 'user')->get();
  
        return view('pages.backsite.login.index', compact('userResourceCollection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if(auth()->attempt($request->only(['SAP', 'password']))) {
    
            $user = auth()->user();
            if ($user->role === 'admin') {
                alert()->success('Success Message', 'Selamat datang ' .$user->name);
                return redirect()->route('admin.dashboard.index');
            } 

            elseif ($user->role === 'user') {
                // Mendapatkan password yang di-hash dari database
                $hashedPassword = $user->password;
    
                // Memeriksa apakah kata sandi default ('123456') cocok dengan kata sandi yang di-hash
                if (Hash::check('123456', $hashedPassword)) {
                    // Tampilkan Sweet Alert memberi tahu pengguna bahwa kata sandi mereka masih default
                    Alert::info('Password Default', 'Password Anda masih menggunakan kata sandi default. Harap segera ganti password demi keamanan akun Anda.');
                    // Arahkan pengguna ke halaman edit profil
                    return redirect()->route('user.profile.index', $user->id);
                } else {
                    // Jika tidak cocok, arahkan pengguna ke dashboard pengguna
                    alert()->success('Success Message', 'Selamat datang ' .$user->name);
                    return redirect()->route('user.dashboard.index');
                }
            }

            // Jika peran visitor
            elseif ($user->role === 'visitor') {
                // Arahkan visitor ke halaman khusus visitor
                alert()->success('Success Message', 'Selamat datang ' . $user->name);
                return redirect()->route('visitor.dashboard.index'); // Ganti dengan route yang sesuai untuk visitor
            }
        }
        
        alert()->error();
        return back()->with('error', 'Gagal login Username dan Password salah');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {

    }
}
