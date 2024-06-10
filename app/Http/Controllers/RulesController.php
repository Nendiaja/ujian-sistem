<?php

namespace App\Http\Controllers;

use App\Models\Rules;
use Illuminate\Http\Request;
use App\Http\Requests\Rules\RulesRequest;

class RulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waktu = Rules::all();

        return view('pages.backsite.master-data.rules.index', compact('waktu'));
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
        $rules = Rules::findOrFail($id);

        return view('pages.backsite.master-data.rules.edit', compact('rules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RulesRequest $request,  $id)
    {
        $data = $request->validated();

        $rules = Rules::find($id);

        $rules->update($data);

        alert()->success('Pesan Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('admin.rules.index');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
