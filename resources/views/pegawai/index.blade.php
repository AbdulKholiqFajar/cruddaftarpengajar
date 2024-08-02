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
                            <a href="{{ route('export.excel') }}" class="btn btn-success"><i class="fa fa-file-excel"></i> Export Excel</a>
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
                                        <td>{{ $item->jp }}</td>
                                        <td>{{ $item->pajak }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            <a href="{{ route('pegawai.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('pegawai.destroy', $item->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data available</td>
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
        $(document).ready(function() {
            $('#pegawaiTable').DataTable({
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
        });
    </script>
@endpush
@endsection