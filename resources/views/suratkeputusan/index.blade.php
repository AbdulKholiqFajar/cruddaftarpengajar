@extends('layouts.admin')

@section('title')
    BAPEKOM IV BANDUNG
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success d-block">{{ session('success') }}</div>
    @endif

    <!-- Filter Form -->
    <form action="{{ route('suratkeputusan.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="start_date">Tanggal Awal</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="end_date">Tanggal Akhir</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('suratkeputusan.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                        <a href="{{ route('export.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export PDF</a>
                        <a href="{{ route('export.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success"><i class="fa fa-file-excel"></i> Export Excel</a>
                    </h3>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table id="suratkeputusanTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Nama</th>
                                <th>Uraian</th>
                                <!-- <th>Sub Mapel</th> -->
                                <th>Gol</th>
                                <th>JP</th>
                                <!-- <th>Tarif JP</th> -->
                                <!-- <th>Jumlah Bruto</th> -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suratkeputusan as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</td>
                                    <td>{{ $item->pegawai?->nama_pengajar }}</td>
                                    <td>{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                                    <!-- <td>{{ $item->sub_mata_pelatihan ? $item->sub_mata_pelatihan->sub_mata_pelatihan : 'Data Tidak Tersedia' }}</td> -->
                                    <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                    <td>{{ number_format($item->jml_jp) }}</td>
                                    <!-- <td>{{ number_format($item->tarif_jp) }}</td> -->
                                    <!-- <td>{{ number_format($item->jumlah_bruto) }}</td> -->
                                    <td>
                                        <a href="{{ route('suratkeputusan.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('suratkeputusan.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Belum Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#suratkeputusanTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pagingType": "simple_numbers",
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Show _MENU_ entri"
                }
            });

            $('.delete').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Kamu yakin hapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke, Hapus!',
                    cancelButtonText: 'Batalkan',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/suratkeputusan/' + id,
                            data: {
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                ).then(() => {
                                    // Redirect to index page
                                    window.location.href = '{{ route('suratkeputusan.index') }}';
                                });
                            },
                            error: function (xhr) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush