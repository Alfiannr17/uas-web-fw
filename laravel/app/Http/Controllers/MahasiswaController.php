<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mahasiswa::all();
        return view("master-data.mahasiswa-master.index-mahasiswa", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("master-data.mahasiswa-master.create-mahasiswa");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi_data = $request->validate([
        'npm' => 'required|unique:mahasiswa',
        'nama' => 'required|string|max:255',
        'prodi' => 'required|string|max:255',    
        ]);

        Mahasiswa::create($validasi_data);
        return redirect()->back()->with('success', 'Mahasiswa berhasil disimpan.');
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
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa) {
            $mahasiswa->delete();
            return redirect()->back()->with('Success', 'Data berhasil dihapus.');
        }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }
}
