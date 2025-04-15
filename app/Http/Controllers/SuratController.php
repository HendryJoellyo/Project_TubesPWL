<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function indexKaprodi()
    {
        $userEmail = session('user_email'); // GANTI auth()->user()
        $kaprodi = User::where('email', $userEmail)->first();

        $surat = Surat::where('status', 'diajukan')->get();

        return view('surat.indexKaprodi', compact('surat'));
    }

    public function approveSurat($id)
    {
        $surat = Surat::findOrFail($id);
        
        // Pastikan hanya surat yang masih dalam status 'diajukan' yang bisa disetujui
        if ($surat->status == 'diajukan') {
            $surat->status = 'disetujui_kaprodi';
            $surat->save();
        }

        return redirect()->route('kaprodi.surat');
    }
    public function indexTU()
    {
        $surat = Surat::where('status', 'disetujui_kaprodi')->get();
        return view('surat.indexTU', compact('surat'));
    }

    public function uploadSurat(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('uploads');
            $surat->file_surat = $filePath;
            $surat->status = 'disetujui_manager';
            $surat->save();
        }

        return redirect()->route('tu.surat');
    }
}
