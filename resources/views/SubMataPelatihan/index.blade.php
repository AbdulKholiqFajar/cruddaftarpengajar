@extends('layouts.admin')

@section('title')
    Sub Mata Pelatihan
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
                        <a href="{{ route('sub_mata_pelatihans.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                        <a href="{{ route('export.pdf.mata_pelatihans') }}" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export PDF</a>
                    </h3>
                </div>

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
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table id="mataPelatihanTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Mata Pelatihan</th>
                                    <th>Mata Pelatihan</th>
                                    <th>Sub Mata Pelatihan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sub_mata_pelatihans as $item)
                                    <tr>
                                        <td>{{ $item->code_sub_mata_pelatihan }}</td>
                                        <td>{{ $item->mata_pelatihan->mata_pelatihan }}</td>
                                        <td>{{ $item->sub_mata_pelatihan }}</td>
                                        <td>
                                            <a href="{{ route('sub_mata_pelatihans.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('sub_mata_pelatihans.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="#" data-id="{{ $item->id }}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
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
            $('#submataPelatihanTable').DataTable({
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
                            url: '/mata_pelatihans/'+ id,
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
                                $('#mataPelatihanTable').DataTable().ajax.reload();
                            },
                        });
                    }
                })
            })
        })
    </script>
@endpush