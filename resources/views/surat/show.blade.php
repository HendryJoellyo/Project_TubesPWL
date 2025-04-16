@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Surat</h2>
    
    <p><strong>Jenis Surat:</strong> {{ \App\Models\Surat::jenisSuratList()[$surat->jenis_surat] }}</p>
    <p><strong>Status:</strong> {{ \App\Models\Surat::statusSuratList()[$surat->status] }}</p>
    <p><strong>Dibuat pada:</strong> {{ $surat->created_at->format('d M Y H:i') }}</p>

    <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
