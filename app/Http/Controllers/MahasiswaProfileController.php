<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaProfile;
use App\Models\Prodi;
use Illuminate\Support\Facades\Log;

class MahasiswaProfileController extends Controller
{
    public function index()
    {
        $mahasiswas = MahasiswaProfile::with('prodi')->get();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $prodis = Prodi::all(); // Ambil semua data prodi untuk dropdown
        return view('admin.mahasiswa.create_mahasiswa', compact('prodis'));
    }

    public function store(Request $request)
    {
        Log::info('Request data:', $request->all()); // Log request data

        $request->validate([
            'nrp' => 'required|unique:mahasiswa_profiles,nrp',
            'name' => 'required',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|unique:mahasiswa_profiles,email',
            'password' => 'required|confirmed|min:6',
            'prodi_id' => 'required|exists:prodi,id', // Pastikan prodi_id valid
        ]);

        $mahasiswa = MahasiswaProfile::create([
            'nrp' => $request->nrp,
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'prodi_id' => $request->prodi_id,
        ]);

        Log::info('Data berhasil disimpan:', $mahasiswa->toArray()); // Log hasil penyimpanan

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit($nrp)
    {
        $mahasiswa = MahasiswaProfile::where('nrp', $nrp)->firstOrFail();
        $prodis = Prodi::all();
        return view('admin.mahasiswa.edit_mahasiswa', compact('mahasiswa', 'prodis'));
    }

    public function update(Request $request, $nrp)
    {
        $mahasiswa = MahasiswaProfile::where('nrp', $nrp)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa_profiles,email,' . $nrp . ',nrp',
            'tanggal_lahir' => 'required|date',
            'password' => 'nullable|min:6|confirmed',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'prodi_id' => $request->prodi_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    public function destroy($nrp)
    {
        $mahasiswa = MahasiswaProfile::where('nrp', $nrp)->firstOrFail();
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
