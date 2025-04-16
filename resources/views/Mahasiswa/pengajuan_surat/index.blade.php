{{-- resources/views/mahasiswa/pengajuan_surat/index.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengajuan Surat</title>
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
        <h1 class="m-0">Daftar Pengajuan Surat</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <a href="{{ route('mahasiswa.pengajuan_surat.create') }}" class="btn btn-primary mb-3">Tambah Pengajuan</a>

        <div class="card">
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Jenis Surat</th>
                  <th>File</th>
                  <th>Status</th> {{-- Kolom status baru --}}
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($pengajuanSurat as $surat)
                  <tr>
                    <td>{{ $surat->id }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $surat->surat->jenis_surat)) }}</td>
                    <td>
                      @if ($surat->file_path)
                        <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank">Lihat File</a>
                      @else
                        <span class="badge badge-warning">Dalam Proses</span>
                      @endif
                    </td>
                    <td>
                      @if ($surat->status == 'diterima')
                        <span class="badge badge-success">Diterima</span>
                      @elseif ($surat->status == 'ditolak')
                        <span class="badge badge-danger">Ditolak</span>
                      @else
                        <span class="badge badge-warning">Menunggu</span>
                      @endif
                    </td>
                    <td>
                      <form action="{{ route('mahasiswa.pengajuan_surat.destroy', $surat->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center">Tidak ada pengajuan surat.</td>
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
