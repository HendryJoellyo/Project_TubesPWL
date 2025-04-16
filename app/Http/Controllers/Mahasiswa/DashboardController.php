<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;

class DashboardController extends Controller
{
    public function index()
{
    $pengajuanSurat = PengajuanSurat::where('uploaded_by', Auth::id())->get();
    return view('mahasiswa.pengajuan_surat.index', compact('pengajuanSurat'));
}
}
