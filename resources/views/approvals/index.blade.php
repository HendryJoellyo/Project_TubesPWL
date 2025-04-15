@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Surat Menunggu Persetujuan</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Jenis Surat</th>
                <th>Mahasiswa</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($approvals as $a)
            <tr>
                <td>{{ \App\Models\Surat::jenisSuratList()[$a->surat->jenis_surat] }}</td>
                <td>{{ $a->surat->mahasiswa->name ?? '-' }}</td>
                <td>{{ \App\Models\Surat::statusSuratList()[$a->surat->status] }}</td>
                <td>
                    <a href="{{ route('approvals.show', $a->id) }}" class="btn btn-info btn-sm">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
