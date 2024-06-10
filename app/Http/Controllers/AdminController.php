<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = User::where('role', 'admin')->get();
        // $kategoris = Kategori::all();

        return view('pages.backsite.master-data.pic.index', compact('datas'));
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
    public function store(AdminRequest $request)
    {
        // Mendapatkan data yang divalidasi dari request
        $validatedData = $request->validated();
   
        // Menambahkan password default jika tidak ada password yang diberikan
        $validatedData['password'] = bcrypt('123456'); 
        $validatedData['role'] = 'admin';
        
        // Membuat user baru dengan data yang telah dimodifikasi
        $user = User::create($validatedData);
        
        // Redirect kembali dengan pesan keberhasilan
        alert()->success('Success Message', 'Berhasil Ditambahkan');
        return redirect()->back();
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
        // Ambil data pengguna dengan ID tertentu
        $user = User::findOrFail($id);
            
        return view('pages.backsite.master-data.pic.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        $data = $request->validated();
    
        // Mengambil pengguna berdasarkan ID yang diberikan
        $user = User::findOrFail($id);
    
        // Memperbarui password jika ada input password baru
        if ($request->input('password') != null) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            $data['password'] = $user->password;
        }
    
        // Memperbarui data pengguna dengan data yang telah divalidasi
        $user->update($data);
    
        alert()->success('Success Message', 'Berhasil Diperbarui');
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.pic.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        alert()->success('Success Message', 'Berhasil Menghapus');
        return redirect()->back(); 
    }
}
