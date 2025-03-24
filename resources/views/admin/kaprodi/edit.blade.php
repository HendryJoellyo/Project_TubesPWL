<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Kaprodi</title>
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
            <h1 class="m-0">Edit Data Kaprodi</h1>
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
              <form action="{{ route('kaprodi.update', $kaprodi->nik) }}" method="POST">

                  @csrf
                  @method('PUT')

                  <div class="form-group">
                      <label for="nik">NIK</label>
                      <input type="text" name="nik" class="form-control" value="{{ $kaprodi->nik }}" readonly>
                  </div>

                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" value="{{ $kaprodi->name }}" required>
                  </div>

                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control" value="{{ $kaprodi->email }}" required>
                  </div>

                  <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" name="tanggal_lahir" class="form-control" value="{{ $kaprodi->tanggal_lahir }}" required>
                  </div>

                  <div class="form-group">
                      <label for="prodi_id">Nama Prodi</label>
                      <select name="prodi_id" class="form-control" required>
                      <option value="">-- Pilih Prodi --</option>
                      @foreach($prodis as $prodi)
                          <option value="{{ $prodi->id }}" {{ $kaprodi->prodi_id == $prodi->id ? 'selected' : '' }}>
                              {{ $prodi->nama_prodi }}
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
