<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;

// ⛔️ Kalau kamu TIDAK pakai "extends Controller", method middleware() tidak akan dikenali!
class ApprovalController extends Controller
{
    public function __construct()
    {
        // Pastikan middleware ini ada setelah extends Controller
        $this->middleware('role:ketua_prodi');
    }

    public function index()
    {
        $surat = Surat::where('status', 'diajukan')->get();
        return view('approval.index', compact('surat'));
    }

    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('approval.show', compact('surat'));
    }

    public function approve(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->status = 'disetujui_kaprodi';
        $surat->save();

        Approval::create([
            'surat_id' => $surat->id,
            'approved_by' => Auth::id(),
            'status' => 'disetujui',
            'catatan' => $request->input('catatan'),
        ]);

        return redirect()->route('approval.index')->with('success', 'Surat disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->status = 'ditolak';
        $surat->save();

        Approval::create([
            'surat_id' => $surat->id,
            'approved_by' => Auth::id(),
            'status' => 'ditolak',
            'catatan' => $request->input('catatan'),
        ]);

        return redirect()->route('approval.index')->with('success', 'Surat ditolak.');
    }
}
