@extends('layouts.admin')

@section('title')
   User Management - Role
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success d-block">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger d-block">{{ session('error') }}</div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Body -->
                <div class="card-header">
                    <h3 class="card-title mb-3 float-right">
                        @can('role-create')
                            <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i> Tambah Data</a>
                        @endcan
                    </h3>

                    <div class="table-responsive">
                        <table id="roleTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @can('role-create')
                                                <a data-url="{{ route('role.show', $role->id) }}" data-url-update="{{ route('role.update', $role->id) }}" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>
                                            @endcan

                                            @can('role-delete')
                                                <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $role->id }}" data-url-delete="{{ route('role.destroy', $role->id) }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan
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
    @include('userManagement.role.create')
    @include('userManagement.role.edit')
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#roleTable').DataTable({
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
            $('.ModalallCheckbox').click(function(e){
                let table= $(e.target).closest('table');
                $('td input:checkbox',table).prop('checked',this.checked);
            });

            $('#roleTable tbody').on('click', '.edit', function () {
                var id = $(this).data('id');
                var url = $(this).data('url-update');
                var url_hit = $(this).data('url');
                $.ajax({
                    url: url_hit,
                    type: 'GET',
                })
                .done(function (response) {
                    if(response.status){
                        $('#name_edit').val(response.data.name);

                        if(response.permissions.length > 0){
                            let html = '';
                            for (let i = 0; i < response.permissions.length; i++) {
                                html += '<tr>'
                                html += '<td><input type="checkbox" class="modal_checbox" name="permission_id[]" value="'+response.permissions[i].id+'" '+response.permissions[i].checked+'></td>'
                                html += '<td>'+response.permissions[i].name+'</td>'
                                html += '</tr>'
                            }
                            $('#tbody-permission').html(html);

                        }

                        $("#form-edit").attr('action', url);
                        $('#modal-edit').modal('show');

                    }

                })
                .fail(function () {
                    console.log("error");
                });
            });


            $('#roleTable tbody').on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = $(this).data('url-delete');
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
                            url: url,
                            data: {
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                if(response.status){
                                    Swal.fire(
                                        'Dihapus!',
                                        'Data berhasil dihapus.',
                                        'success'
                                    ).then(() => {
                                        // Redirect to index page
                                        window.location.href = '{{ route('role.index') }}';
                                    });
                                }
                                   
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