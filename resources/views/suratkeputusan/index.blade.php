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
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('suratkeputusan.create') }}" class="btn btn-primary"><i class="fa fa-plus"> Tambah Data</i></a>
                         <a href="{{ route('export.pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf"> Export PDF</i></a>
                         <a href="{{ route('export.excel') }}" class="btn btn-success"><i class="fa fa-file-excel"> Export Excel</i></a>
                    </h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table id="suratkeputusanTable" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>TANGGAL</th>
                            <th>WAKTU</th>
                            <th>NAMA</th>
                            <th>URAIAN</th>
                            <th>GOL</th>
                            <th>JUMLAH JP</th>
                            <th>TARIF JP</th>
                            <th>JUMLAH BRUTO</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($suratkeputusan as $item)
                            <tr>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->waktu }}</td>
                                <td>{{ $item->nama_pengajar }}</td>
                                <td>{{ $item->mapel }}</td>
                                <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                <td>{{ $item->jml_jp }}</td>
                                <td>{{ $item->tarif_jp }}</td>
                                <td>{{ $item->jumlah_bruto }}</td>
                                <td>
                                    <a href="{{ route('suratkeputusan.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a id="delete" data-id="{{ $item->id }}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum Ada Data</td>
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
        $(document).ready(function() {
            $('#suratkeputusanTable').DataTable();

            $('.delete').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log(id);
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
                                console.log(response);
                                Swal.fire(
                                    'Dihapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                );

                                $('#suratkeputusanTable').DataTable().ajax.reload(); // Reload DataTable
                            },
                        });
                    }
                });
            });
        });
    </script>
@endpush