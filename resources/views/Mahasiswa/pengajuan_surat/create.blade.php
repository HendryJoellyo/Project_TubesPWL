<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Pengajuan Surat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS AdminLTE -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('partials.navbar')
  @include('partials.sidebar_mahasiswa')

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h2>Upload Pengajuan Surat</h2>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">

        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('mahasiswa.pengajuan_surat.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="surat_id">Jenis Surat</label>
            <select name="surat_id" class="form-control" required>
              <option value="">Pilih Jenis Surat</option>
              @foreach($surats as $surat)
                <option value="{{ $surat->id }}">{{ ucfirst(str_replace('_', ' ', $surat->jenis_surat)) }}</option>
              @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-primary mt-3">Kirim</button>
          <a href="{{ route('mahasiswa.pengajuan_surat.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>

      </div>
    </div>
  </div>

  <footer class="main-footer">
    @include('partials.footer')
  </footer>

</div>

<!-- JS AdminLTE -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
