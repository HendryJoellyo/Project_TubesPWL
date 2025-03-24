<?php

namespace App\Http\Controllers;

use App\Models\TataUsahaProfile;
use Illuminate\Http\Request;
use App\Models\KetuaProdiProfile;
use App\Models\Prodi;
use App\Models\DosenProfile;


class TataUsahaProfileController extends Controller
{
    public function index()
    {
        $TataUsahas = TataUsahaProfile::with('prodi')->get();
        return view('admin.tata_usaha.index', compact('TataUsahas'));
    }

    public function create()
{
    $TataUsaha = TataUsahaProfile::all(); // Ambil semua data dosen
    $prodis = Prodi::all(); // Ambil semua data prodi
    return view('admin.tata_usaha.create', compact('TataUsaha'));
}


public function store(Request $request)
{
    $request->validate([
        'nik' => 'required|unique:ketua_prodi_profiles',
        'name' => 'required',
        'email' => 'required|email',
        'tanggal_lahir' => 'required|date',
        'password' => 'required',
    ]);

    TataUsahaProfile::create([
        'nik' => $request->nik,
        'name' => $request->name,
        'email' => $request->email,
        'tanggal_lahir' => $request->tanggal_lahir,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('tata_usaha.index')->with('success', 'Tata Usaha berhasil ditambahkan!');
}


    public function edit($nik)
{
    $TataUsaha = TataUsahaProfile::where('nik', $nik)->firstOrFail();
  

    return view('admin.tata_usaha.edit', compact('TataUsaha'));
}


public function update(Request $request, $nik)
{
    // Validasi data
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'tanggal_lahir' => 'required|date',
    ]);

    // Cek apakah data ditemukan
    $TataUsaha = TataUsahaProfile::where('nik', $nik)->first();
    if (!$TataUsaha) {
        return back()->with('error', 'Data tidak ditemukan!');
    }

    // Perbarui data
    $TataUsaha->update([
        'name' => $request->name,
        'email' => $request->email,
        'tanggal_lahir' => $request->tanggal_lahir,
    ]);
    

    return redirect()->route('tata_usaha.index')->with('success', 'Data berhasil diperbarui');
}




    public function destroy($nik)
    {
        $TataUsaha = TataUsahaProfile::where('nik', $nik)->firstOrFail();
        $TataUsaha->delete();

        return redirect()->route('tata_usaha.index')->with('success', 'Data Tata Usaha berhasil dihapus!');
    }



}
