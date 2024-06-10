<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Setting\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcement = Settings::all();

        return view('pages.backsite.master-data.settings.index', compact('announcement'));
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
    public function store(SettingRequest $request)
    {
        Settings::create($request->validated());

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
        $announcement = Settings::findOrFail($id);

        return view('pages.backsite.master-data.settings.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request,  $id)
    {
        $data = $request->validated();

        $announcement = Settings::find($id);

        $announcement->update($data);

        alert()->success('Pesan Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('admin.announcement.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settings $announcement)
    {
        try {
            $announcement->delete();
            alert()->success('Success Message', 'Berhasil Dihapus');
        } catch (\Exception $e) {
            alert()->error('Error Message', 'Gagal Menghapus: ' . 'Masih ada soal di Kategori ini !');
        }
        
        return redirect()->route('admin.announcement.index');
    }
}
