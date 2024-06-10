<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        return view('pages.frontsite.profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function updatePasswordBaru(Request $request, $id) {

        $user = User::findOrFail($id);

        if ($request->input('password') != null) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        // Redirect kembali dengan pesan sukses

        alert()->success('Success Message', 'Berhasil Diperbarui');
        return redirect()->route('user.dashboard.index');

    }

    public function update(Request $request, $id)
    {
    // Mengambil pengguna berdasarkan ID yang diberikan
    $user = User::findOrFail($id);

    // Memverifikasi password lama
    if (Hash::check($request->input('passwordlama'), $user->password)) {
        // Jika password lama cocok, lanjutkan dengan proses update

        // Memperbarui password jika ada input password baru
        if ($request->input('passwordbaru') != null) {
            $user->password = Hash::make($request->input('passwordbaru'));
        }

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses

        alert()->success('Success Message', 'Berhasil Diperbarui');
        
        return redirect()->route('user.dashboard.index');
    } else {
        // Jika password lama tidak cocok, kembalikan dengan pesan kesalahan
        alert()->error('Error Message', 'Pasword lama salah');

        return redirect()->back();
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
