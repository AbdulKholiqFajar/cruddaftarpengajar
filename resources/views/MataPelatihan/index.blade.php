@extends('layouts.admin')

@section('title')
    Daftar Mata Pelatihan
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success d-block">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Body -->
                <div class="card-header">
                    <h3 class="card-title mb-3">
                        @can('mata-pelatihan-create')
                            <a href="{{ route('mata_pelatihans.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                            {{-- <a href="{{ route('export.pdf.mata_pelatihans') }}" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export PDF</a> --}}
                        @endcan
                    </h3>
                   
                    <div class="table-responsive">
                        <table id="mataPelatihanTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Mata Pelatihan</th>
                                    <th>Jumlah JP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mata_pelatihans as $item)
                                    <tr>
                                        <td>{{ $item->mata_pelatihan }}</td>
                                        <td>{{ $item->jml_jp }}</td>
                                        <td>
                                            <a href="{{ route('mata_pelatihans.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                            @can('mata-pelatihan-edit')
                                                <a href="{{ route('mata_pelatihans.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('mata-pelatihan-delete')
                                                <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $item->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
            $('#mataPelatihanTable').DataTable({
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
                            url: '/mata_pelatihans/' + id,
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
                                    window.location.href = '{{ route('mata_pelatihans.index') }}';
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