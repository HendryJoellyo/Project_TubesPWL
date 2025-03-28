@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Surat Baru</h2>

    <form action="{{ route('surat.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="jenis_surat">Jenis Surat</label>
            <select name="jenis_surat" class="form-control" required>
                <option value="">Pilih Jenis Surat</option>
                @foreach($jenis_surat as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Ajukan</button>
        <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
