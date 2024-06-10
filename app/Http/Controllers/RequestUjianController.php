<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KategoriUser;
use Illuminate\Http\Request;

class RequestUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data KategoriUser dengan status "pending"
        $kategorisPending = KategoriUser::where('status', 'pending')->get();

        // Mengirim data ke view untuk ditampilkan dengan compact
        return view('pages.backsite.master-data.request.index', compact('kategorisPending'));
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

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
