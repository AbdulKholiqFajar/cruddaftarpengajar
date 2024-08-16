@extends('layouts.admin')

@section('title')
   User Management - User
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
                        @can('user-create')
                            <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i> Tambah Data</a>
                        @endcan
                    </h3>

                    <div class="table-responsive">
                        <table id="userTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{$user->roles->pluck('name')[0] ?? '-'}}</td>
                                        <td>
                                            @can('user-create')
                                                <a data-url="{{ route('user.show', $user->id) }}" data-url-update="{{ route('user.update', $user->id) }}" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>
                                            @endcan

                                            @can('user-delete')
                                                <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $user->id }}" data-url-delete="{{ route('user.destroy', $user->id) }}">
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
    @include('userManagement.user.create')
    @include('userManagement.user.edit')
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable({
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

            $('#userTable tbody').on('click', '.edit', function () {
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
                        $('#email_edit').val(response.data.email);
                        $('#password_edit').val(response.data.password);

                        let option_role = "";
                        for (let i = 0; i < response.roles.length; i++) {
                            let selected_role = response.roles[i].selected ? "selected='"+response.roles[i].selected+"'" : ""
                            option_role += "<option value='"+response.roles[i].id+"' "+selected_role+">"+response.roles[i].name+"</option>";
                        }
                        $('.role_id_edit').html(option_role);


                        $("#form-edit").attr('action', url);
                        $('#modal-edit').modal('show');

                    }
                })
                .fail(function () {
                    console.log("error");
                });
            });


            $('#userTable tbody').on('click', '.delete', function (e) {
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
                                        window.location.href = '{{ route('user.index') }}';
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