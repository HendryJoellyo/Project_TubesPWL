@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Surat</h2>

    <p><strong>Jenis Surat:</strong> {{ \App\Models\Surat::jenisSuratList()[$surat->jenis_surat] }}</p>
    <p><strong>Status:</strong> {{ \App\Models\Surat::statusSuratList()[$surat->status] }}</p>
    <p><strong>Dibuat pada:</strong> {{ $surat->created_at->format('d M Y H:i') }}</p>

    <form action="{{ route('approval.approve', $surat->id) }}" method="POST" class="mb-2">
        @csrf
        <div class="form-group">
            <label>Catatan:</label>
            <textarea name="catatan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Setujui</button>
    </form>

    <form action="{{ route('approval.reject', $surat->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Catatan Penolakan:</label>
            <textarea name="catatan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-danger mt-2">Tolak</button>
    </form>

    <a href="{{ route('approval.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
