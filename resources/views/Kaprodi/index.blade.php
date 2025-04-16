{{-- resources/views/kaprodi/pengajuan_surat/index.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengajuan Surat Mahasiswa - Kaprodi</title>
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('partials.navbar')
  @include('partials.sidebar_mahasiswa') {{-- Ganti ke sidebar kaprodi --}}

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Daftar Pengajuan Surat Mahasiswa</h1>
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
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($pengajuanSurat as $surat)
                  <tr>
                    <td>{{ $surat->id }}</td>
                    <td>{{ $surat->user->name ?? '-' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $surat->surat->jenis_surat ?? '')) }}</td>
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
                      @if ($surat->status === 'menunggu')
                        <form action="{{ route('kaprodi.pengajuan_surat.setujui', $surat->id) }}" method="POST" class="d-inline">
                          @csrf
                          <button class="btn btn-success btn-sm">Setujui</button>
                        </form>
                        <form action="{{ route('kaprodi.pengajuan_surat.tolak', $surat->id) }}" method="POST" class="d-inline">
                          @csrf
                          <button class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                      @else
                        <span class="text-muted">Sudah Diproses</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center">Belum ada pengajuan surat.</td>
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
