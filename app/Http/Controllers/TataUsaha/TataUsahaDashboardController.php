<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;

class TataUsahaDashboardController extends Controller
{
    public function index()
{
    $pengajuanSurat = PengajuanSurat::all();
    return view('tatausaha.index', compact('pengajuanSurat'));
}
}
