@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Surat</h2>
    <a href="{{ route('surat.create') }}" class="btn btn-primary mb-3">Buat Surat Baru</a>

    <table class="table">
        <thead>
            <tr>
                <th>Jenis Surat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $s)
            <tr>
                <td>{{ \App\Models\Surat::jenisSuratList()[$s->jenis_surat] }}</td>
                <td>{{ \App\Models\Surat::statusSuratList()[$s->status] }}</td>
                <td>
                    <a href="{{ route('surat.show', $s->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    @if($s->status == 'diajukan')
                        <form action="{{ route('surat.destroy', $s->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
