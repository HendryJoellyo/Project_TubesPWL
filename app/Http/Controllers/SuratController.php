<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function __construct()
    {
        // // Gunakan middleware dalam constructor
        // $this->middleware('auth');
        // $this->middleware('role:mahasiswa'); // Pastikan ada middleware 'role'
    }

    // Tampilkan daftar surat mahasiswa yang login
    public function index()
    {
        $surat = Surat::where('mahasiswa_nrp', Auth::user()->nrp)->get();
        return view('surat.index', compact('surat'));
    }

    // Form pengajuan surat baru
    public function create()
    {
        $jenis_surat = Surat::jenisSuratList();
        return view('surat.create', compact('jenis_surat'));
    }

    // Simpan surat baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:keterangan_aktif,pengantar_tugas,keterangan_lulus,laporan_hasil_studi',
        ]);

        Surat::create([
            'mahasiswa_nrp' => Auth::user()->nrp,
            'jenis_surat' => $request->jenis_surat,
            'status' => 'diajukan',
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diajukan.');
    }

    // Tampilkan detail surat
    public function show($id)
    {
        $surat = Surat::where('mahasiswa_nrp', Auth::user()->nrp)->findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    // Hapus surat (hanya bisa jika status masih "diajukan")
    public function destroy($id)
    {
        $surat = Surat::where('mahasiswa_nrp', Auth::user()->nrp)->where('status', 'diajukan')->findOrFail($id);
        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }
}
