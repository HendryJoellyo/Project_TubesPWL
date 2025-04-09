<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    // Menampilkan semua surat tanpa filter
    public function index()
    {
        $surat = Surat::all();
        return view('surat.index', compact('surat'));
    }

    // Form untuk membuat surat baru
    public function create()
    {
        $jenis_surat = Surat::jenisSuratList();
        return view('surat.create', compact('jenis_surat'));
    }

    // Simpan surat ke database
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:keterangan_aktif,pengantar_tugas,keterangan_lulus,laporan_hasil_studi',
        ]);

        Surat::create([
            'mahasiswa_nrp' => Auth::user()->nrp, // tetap gunakan Auth di sini jika login masih diperlukan
            'jenis_surat' => $request->jenis_surat,
            'status' => 'diajukan',
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diajukan.');
    }

    // Menampilkan detail surat
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    // Menghapus surat jika status masih "diajukan"
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->status === 'diajukan') {
            $surat->delete();
        }

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }
}
