<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KetuaProdiProfile;
use App\Models\Prodi;
use App\Models\DosenProfile;


class KetuaProdiProfileController extends Controller
{
    public function index()
    {
        $profiles = KetuaProdiProfile::with('prodi')->get();
        return view('admin.kaprodi.dashboard', compact('profiles'));
    }

    public function create()
{
    $dosens = DosenProfile::all(); // Ambil semua data dosen
    $prodis = Prodi::all(); // Ambil semua data prodi
    return view('admin.kaprodi.create', compact('dosens', 'prodis'));
}


public function store(Request $request)
{
    $request->validate([
        'nik' => 'required|unique:ketua_prodi_profiles',

        'name' => 'required',
        'email' => 'required|email',
        'tanggal_lahir' => 'required|date',
        'password' => 'required',
        'dosen_nik' =>'required',
        'prodi_id' => 'required',
    ]);

    KetuaProdiProfile::create([
        'nik' => $request->nik,
        'name' => $request->name,
        'email' => $request->email,
        'tanggal_lahir' => $request->tanggal_lahir,
        'password' => bcrypt($request->password),
        'prodi_id' => $request->id,
        'dosen_nik' => $request->dosen_nik,
    ]);

    return redirect()->route('kaprodi.index')->with('success', 'Kaprodi berhasil ditambahkan!');
}


    public function edit($nik)
{
    $kaprodi = KetuaProdiProfile::where('nik', $nik)->firstOrFail();
    $prodis = Prodi::all(); // Ambil semua data prodi

    return view('admin.kaprodi.edit', compact('kaprodi', 'prodis'));
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
    $kaprodi = KetuaProdiProfile::where('nik', $nik)->first();
    if (!$kaprodi) {
        return back()->with('error', 'Data tidak ditemukan!');
    }

    // Perbarui data
    $kaprodi->update([
        'name' => $request->name,
        'email' => $request->email,
        'tanggal_lahir' => $request->tanggal_lahir,
        'prodi_id' => $request->prodi_id, // Pastikan ini ada
    ]);
    

    return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui');
}




    public function destroy($nik)
    {
        $kaprodi = KetuaProdiProfile::where('nik', $nik)->firstOrFail();
        $kaprodi->delete();

        return redirect()->route('dashboard')->with('success', 'Data Kaprodi berhasil dihapus!');
    }



}
