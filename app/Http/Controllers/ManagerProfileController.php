<?php

namespace App\Http\Controllers;

use App\Models\ManagerProfile;
use Illuminate\Http\Request;
use App\Models\KetuaProdiProfile;
use App\Models\Prodi;
use App\Models\DosenProfile;


class ManagerProfileController extends Controller
{
    public function index()
    {
        $Managers = ManagerProfile::with('prodi')->get();
        return view('admin.manager.index', compact('Managers'));
    }

    public function create()
{
    $Managers = ManagerProfile::all(); // Ambil semua data dosen
    return view('admin.manager.create', compact('Managers'));
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

    ManagerProfile::create([
        'nik' => $request->nik,
        'name' => $request->name,
        'email' => $request->email,
        'tanggal_lahir' => $request->tanggal_lahir,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('manager.index')->with('success', 'Manager berhasil ditambahkan!');
}


    public function edit($nik)
{
    $Manager = ManagerProfile::where('nik', $nik)->firstOrFail();
  

    return view('admin.manager.edit', compact('Manager'));
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
    $Manager = ManagerProfile::where('nik', $nik)->first();
    if (!$Manager) {
        return back()->with('error', 'Data tidak ditemukan!');
    }

    // Perbarui data
    $Manager->update([
        'name' => $request->name,
        'email' => $request->email,
        'tanggal_lahir' => $request->tanggal_lahir,
    ]);
    

    return redirect()->route('manager.index')->with('success', 'Data berhasil diperbarui');
}




    public function destroy($nik)
    {
        $Manager = ManagerProfile::where('nik', $nik)->firstOrFail();
        $Manager->delete();

        return redirect()->route('manager.index')->with('success', 'Data Tata Usaha berhasil dihapus!');
    }



}
