<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KetuaProdiProfile;
use App\Models\Prodi;


class KetuaProdiProfileController extends Controller
{
    public function index()
    {
        $profiles = KetuaProdiProfile::with('prodi')->get();
        return view('tata_usaha.kaprodi.dashboard', compact('profiles'));
    }

    public function create()
{
    $prodis = Prodi::all();
    return view('tata_usaha.kaprodi.create', compact('prodis'));
}

    public function store(Request $request)
    {
        KetuaProdiProfile::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'prodi_id' => $request->prodi_id,

            'password' => bcrypt($request->password), // Simpan password dengan hash
        ]);

        return redirect()->route('dashboard')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($nik)
{
    $kaprodi = KetuaProdiProfile::where('nik', $nik)->firstOrFail();
    $prodis = Prodi::all(); // Ambil semua data prodi

    return view('tata_usaha.kaprodi.edit', compact('kaprodi', 'prodis'));
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

    public function prodi()
{
    return $this->hasOne(Prodi::class, 'ketua_prodi_nik', 'nik');
}

}
