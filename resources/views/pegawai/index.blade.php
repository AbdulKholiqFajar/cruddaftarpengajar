@extends('layouts.admin')

@section('title')
    Daftar Pengajar
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success d-block">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-container">
                            <a href="{{ route('pegawai.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                            <a href="{{ route('export.pdf.pegawai') }}" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export PDF</a>
                            <!-- <a href="{{ route('export.excel') }}" class="btn btn-success"><i class="fa fa-file-excel"></i> Export Excel</a> -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="pegawaiTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama Pengajar</th>
                                    <th>Jabatan</th>
                                    <th>Golongan</th>
                                    <th>Tarif JP</th>
                                    <th>Pajak</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pegawai as $item)
                                    <tr>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->nama_pengajar }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                        <td>{{ number_format($item->honor) }}</td>
                                        <td>{{ number_format($item->pajak) }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            <a href="{{ route('pegawai.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#pegawaiTable').DataTable({
                "paging": true,
                "lengthChange": true,
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

            $('.delete').click(function (e) {
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
                            url: '/pegawai/' + id,
                            data: {
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                ).then(() => {
                                    // Redirect to index page
                                    window.location.href = '{{ route('pegawai.index') }}';
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
@endsection