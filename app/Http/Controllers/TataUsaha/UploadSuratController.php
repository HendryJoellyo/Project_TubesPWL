<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadSuratController extends Controller
{
    public function index()
    {
        $pengajuanSurat = Upload::with('user', 'surat')
            ->where('status', 'diterima')
            ->orderByDesc('created_at')
            ->get();

        return view('tata_usaha.upload_surat.index', compact('pengajuanSurat'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'file_balasan' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $upload = Upload::findOrFail($id);

        if ($upload->file_balasan) {
            Storage::delete('public/' . $upload->file_balasan);
        }

        $filePath = $request->file('file_balasan')->store('balasan_surat', 'public');
        $upload->file_balasan = $filePath;
        $upload->save();

        return back()->with('success', 'File surat berhasil diupload.');
    }
}
