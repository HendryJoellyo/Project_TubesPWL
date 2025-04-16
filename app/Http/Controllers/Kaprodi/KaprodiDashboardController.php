<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;

class KaprodiDashboardController extends Controller
{
    public function index()
    {
        $pengajuanSurat = PengajuanSurat::with('user', 'surat')->get();
        return view('kaprodi.index', compact('pengajuanSurat'));
    }
    
}
