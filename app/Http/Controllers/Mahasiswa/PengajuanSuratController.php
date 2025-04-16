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
    {
        // Ambil semua data pengajuan surat
        $pengajuanSurat = PengajuanSurat::all();
        // Kirim ke view
        return view('mahasiswa.pengajuan_surat.index', compact('pengajuanSurat'));

    }
    



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

    ]);

    return redirect()->route('mahasiswa.pengajuan_surat.index')->with('success', 'Surat berhasil diajukan.');
}

public function destroy($id)
{
    $surat = PengajuanSurat::where('id', $id)->where('uploaded_by', Auth::user()->id)->firstOrFail();

    // Hapus file hanya jika ada path dan file-nya memang ada
    if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
        Storage::disk('public')->delete($surat->file_path);
    }

    $surat->delete();

    return redirect()->route('mahasiswa.pengajuan_surat.index')->with('success', 'Surat berhasil dihapus.');
}

}
