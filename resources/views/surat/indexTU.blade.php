<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard TU</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
            <h1 class="m-0">Upload Surat Masuk</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Upload File Surat</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pengaju</th>
                      <th>Judul</th>
                      <th>Status</th>
                      <th>File</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($surat as $s)
                    <tr>
                      <td>{{ $s->id }}</td>
                      <td>{{ $s->pengaju }}</td>
                      <td>{{ $s->judul }}</td>
                      <td>{{ $s->status }}</td>
                      <td>
                        @if ($s->file)
                          <a href="{{ asset('storage/surat/'.$s->file) }}" target="_blank">Lihat File</a>
                        @else
                          <span class="text-muted">Belum ada</span>
                        @endif
                      </td>
                      <td>
                        <form action="{{ route('tu.upload', $s->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                          @csrf
                          <input type="file" name="file" class="form-control-file mb-2" required>
                          <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    @if ($surat->isEmpty())
                    <tr>
                      <td colspan="6" class="text-center">Belum ada surat tersedia.</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
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

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
