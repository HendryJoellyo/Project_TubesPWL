<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PengajuanSuratController extends Controller
{
    public function index()
<<<<<<< HEAD
{
    $nrp = Auth::user()->nrp;

    // Ambil semua pengajuan milik mahasiswa ini
    $pengajuanSurat = PengajuanSurat::where('mahasiswa_nrp', $nrp)->with('surat')->get();

    // Ambil semua upload milik mahasiswa ini
    $uploads = \App\Models\Upload::where('mahasiswa_nrp', $nrp)->get()->keyBy('surat_id');

    return view('mahasiswa.pengajuan_surat.index', compact('pengajuanSurat', 'uploads'));
}

=======
    {
        // Ambil semua data pengajuan surat
        $pengajuanSurat = PengajuanSurat::all();
        // Kirim ke view
        return view('mahasiswa.pengajuan_surat.index', compact('pengajuanSurat'));

    }
    
>>>>>>> ac7c495be41d54213b953494ba0466e46c144335



public function create()
{
    $surats = Surat::all();  // Ambil semua data surat dari tabel surat
    return view('mahasiswa.pengajuan_surat.create', compact('surats'));  // Pass data surat ke view
}


public function store(Request $request)
{
    $request->validate([
        'surat_id' => 'required|integer',
    ]);

    PengajuanSurat::create([
        'surat_id' => $request->surat_id,
<<<<<<< HEAD
        'mahasiswa_nrp' => Auth::user()->nrp,
=======

>>>>>>> ac7c495be41d54213b953494ba0466e46c144335
    ]);

    return redirect()->route('mahasiswa.pengajuan_surat.index')->with('success', 'Surat berhasil diajukan.');
}

<<<<<<< HEAD

public function destroy($id)
{
    $surat = PengajuanSurat::where('id', $id)->firstOrFail();
=======
public function destroy($id)
{
    $surat = PengajuanSurat::where('id', $id)->where('uploaded_by', Auth::user()->id)->firstOrFail();

>>>>>>> ac7c495be41d54213b953494ba0466e46c144335
    // Hapus file hanya jika ada path dan file-nya memang ada
    if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
        Storage::disk('public')->delete($surat->file_path);
    }

    $surat->delete();

    return redirect()->route('mahasiswa.pengajuan_surat.index')->with('success', 'Surat berhasil dihapus.');
}

}
