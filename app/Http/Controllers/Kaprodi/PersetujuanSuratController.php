<?php
namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Illuminate\Http\Request;

class PersetujuanSuratController extends Controller
{
    public function index()
    {
        $pengajuanSurat = Upload::with('surat', 'user')->latest()->get();
        return view('kaprodi.pengajuan_surat.index', compact('pengajuanSurat'));
    }

    public function setujui($id)
    {
        $upload = Upload::findOrFail($id);
        $upload->status = 'diterima';
        $upload->save();

        return back()->with('success', 'Surat berhasil disetujui.');
    }

    public function tolak($id)
    {
        $upload = Upload::findOrFail($id);
        $upload->status = 'ditolak';
        $upload->save();

        return back()->with('success', 'Surat berhasil ditolak.');
    }
}
