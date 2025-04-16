<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upload Surat - Tata Usaha</title>
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
        <h1 class="m-0">Upload Surat yang Sudah Disetujui</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Mahasiswa</th>
                  <th>Jenis Surat</th>
                  <th>Status</th>
                  <th>File</th>
                  <th>Upload Balasan</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($pengajuanSurat as $surat)
                  <tr>
                    <td>{{ $surat->id }}</td>
                    <td>{{ $surat->user->name ?? '-' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $surat->surat->jenis_surat ?? '')) }}</td>
                    <td><span class="badge badge-success">Diterima</span></td>
                    <td>
                      @if ($surat->file_balasan)
                        <a href="{{ asset('storage/' . $surat->file_balasan) }}" target="_blank">Lihat File</a>
                      @else
                        <span class="text-warning">Belum diupload</span>
                      @endif
                    </td>
                    <td>
                      @if (!$surat->file_balasan)
                      <form action="{{ route('tata_usaha.upload_surat.store', $surat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file_balasan" class="form-control mb-2" required>
                        <button class="btn btn-primary btn-sm">Upload</button>
                      </form>
                      @else
                        <span class="text-muted">Sudah diupload</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada surat yang disetujui.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
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
