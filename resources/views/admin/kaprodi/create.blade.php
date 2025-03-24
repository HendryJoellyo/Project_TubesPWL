<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create New kaprodi</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('partials.navbar')
  <!-- Main Sidebar Container -->
  @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create New Kaprodi</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
              <form action="{{ route('store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="dosen_nik">Nama Dosen</label>
        <select name="dosen_nik" class="form-control" required>
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosens as $dosen)
                <option value="{{ $dosen->nik }}">{{ $dosen->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="prodi_id">Nama Prodi</label>
        <select name="prodi_id" class="form-control" required>
            <option value="">-- Pilih Prodi --</option>
            @foreach($prodis as $prodi)
                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    @include('partials.footer')
  </footer>
</div>

<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
