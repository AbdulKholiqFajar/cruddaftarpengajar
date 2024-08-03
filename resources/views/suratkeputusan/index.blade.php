@extends('layouts.admin')

@section('title')
    BAPEKOM IV BANDUNG
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success d-block">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('suratkeputusan.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                        <a href="{{ route('export.pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export PDF</a>
                        <a href="{{ route('export.excel') }}" class="btn btn-success"><i class="fa fa-file-excel"></i> Export Excel</a>
                    </h3>

                    <!-- <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table id="suratkeputusanTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Nama</th>
                                <th>Uraian</th>
                                <th>Gol</th>
                                <th>Jumlah JP</th>
                                <th>Tarif JP</th>
                                <th>Jumlah Bruto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suratkeputusan as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y'), }}</td>
                                    <td>{{ $item->start_time.' - '.$item->end_time }}</td>
                                    <td>{{ $item->pegawai?->nama_pengajar }}</td>
                                    <td>{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                                    <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                    <td>{{ number_format($item->jml_jp) }}</td>
                                    <td>{{ number_format($item->tarif_jp) }}</td>
                                    <td>{{ number_format($item->jumlah_bruto) }}</td>
                                    <td>
                                        <a href="{{ route('suratkeputusan.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('suratkeputusan.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-id="{{ $item->id }}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
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
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pagingType": "simple_numbers",
                "language": {
                    "search": "Search:"
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
                            url: '/suratkeputusan/'+ id,
                            data: {
                                'id': id,
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                )
                                $('#suratkeputusanTable').DataTable().ajax.reload();
                            },
                        });
                    }
                })
            })
        })
    </script>
@endpush