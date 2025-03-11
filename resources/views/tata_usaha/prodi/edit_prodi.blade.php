<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Data Prodi</title>
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('partials.navbar')
  @include('partials.sidebar')

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Data Prodi</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <label for="nama_prodi">Nama Prodi</label>
                    <input type="text" name="nama_prodi" class="form-control" value="{{ $prodi->nama_prodi }}" required>
                  </div>

                  <div class="form-group">
                    <label for="ketua_prodi_nik">Ketua Prodi</label>
                    <select name="ketua_prodi_nik" class="form-control">
                        <option value="">-- Pilih Ketua Prodi --</option>
                        @foreach ($ketua_prodis as $kaprodi)
                            <option value="{{ $kaprodi->nik }}" {{ $prodi->ketua_prodi_nik == $kaprodi->nik ? 'selected' : '' }}>
                                {{ $kaprodi->name }} ({{ $kaprodi->nik }})
                            </option>
                        @endforeach
                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('partials.footer')
</div>

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
