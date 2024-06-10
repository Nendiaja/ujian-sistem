<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Department;
use App\Models\BussinesUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa peran pengguna
        if ($user->role === 'visitor') {
            // Mendapatkan Business Unit dari pengguna yang sedang login
            $visitorBU = $user->BU;

            // Mengambil data pengguna dengan peran 'user' dan Business Unit yang sama dengan visitor
            $datas = User::where('role', 'user')
                         ->where('BU', $visitorBU)
                         ->with('kategoriUser.kategori') // Eager load relasi kategoriUsers dan kategori
                         ->get();
        } else {
            // Jika bukan visitor, tampilkan semua user dengan peran user
            $datas = User::where('role', 'user')
                         ->with('kategoriUsers.kategori') // Eager load relasi kategoriUsers dan kategori
                         ->get();
        }

        // dd($datas);

        $kategoris = Kategori::all();
        $BU = BussinesUnit::all();
        $department = Department::with('bussinesUnit')->get();
        $roles = ['user', 'admin', 'visitor'];

        $title = "Data User " . $visitorBU;

        return view('pages.visitor.dashboard.index', compact('datas', 'kategoris', 'BU', 'department', 'roles', 'title'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
