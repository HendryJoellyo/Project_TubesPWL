<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\KetuaProdiProfile;
class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::with('ketuaProdiProfile')->get();
        return view('tata_usaha.prodi.index', compact('prodis'));
    }

    public function create()
{
    $ketua_prodis = KetuaProdiProfile::all();
    return view('tata_usaha.prodi.create_prodi', compact('ketua_prodis'));
}

public function store(Request $request)
{
    $request->validate([
        'nama_prodi' => 'required',
        'ketua_prodi_nik' => 'nullable|exists:ketua_prodi_profiles,nik',
    ]);

    Prodi::create([
        'nama_prodi' => $request->nama_prodi,
        'ketua_prodi_nik' => $request->ketua_prodi_nik
    ]);

    return redirect()->route('prodi.index')->with('success', 'Data berhasil ditambahkan');
}


public function edit($id)
{
    $prodi = Prodi::findOrFail($id);
    $ketua_prodis = KetuaProdiProfile::all();
    return view('tata_usaha.prodi.edit_prodi', compact('prodi', 'ketua_prodis'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi' => 'required',
            'ketua_prodi_nik' => 'required',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());
        return redirect()->route('prodi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
{
    Prodi::destroy($id); // Hapus data berdasarkan ID

    // Ambil ulang semua data dan reset ulang ID secara manual
    $prodis = Prodi::orderBy('id')->get();
    $new_id = 1;

    foreach ($prodis as $prodi) {
        $prodi->id = $new_id;
        $prodi->save();
        $new_id++;
    }

    \DB::statement('ALTER TABLE prodi AUTO_INCREMENT = ' . ($new_id)); // Reset auto-increment

    return redirect()->route('prodi.index')->with('success', 'Data berhasil dihapus dan ID diurutkan ulang');
}



}
