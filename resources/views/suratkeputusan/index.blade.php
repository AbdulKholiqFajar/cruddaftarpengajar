@extends('layouts.admin')

@section('title')
    Daftar SK
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                
                <a href="{{ route('sk.create') }}" class="btn btn-primary float-right">Tambah SK</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="sk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor SK</th>
                            <th>Tanggal SK</th>
                            <th>Tahun</th>
                            {{-- <th>Tentang</th>
                            <th>Menimbang</th>
                            <th>Mengingat</th>
                            <th>Menetapkan</th>
                            <th>Tembusan</th>
                            <th>Isi</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skList as $index => $sk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sk->nomor_sk }}</td>
                            <td>{{ $sk->tanggal_sk->format('d-m-Y') }}</td>
                            <td>{{ $sk->tahun }}</td>
                            {{-- <td>{!! Str::limit($sk->tentang, 50) !!}</td>
                            <td>{!! Str::limit($sk->menimbang, 50) !!}</td>
                            <td>{!! Str::limit($sk->mengingat, 50) !!}</td>
                            <td>{!! Str::limit($sk->menetapkan, 50) !!}</td>
                            <td>{!! Str::limit($sk->tembusan, 50) !!}</td>
                            <td>{!! Str::limit($sk->isi, 50) !!}</td> --}}
                            <td>
                                <a href="{{ route('sk.show', $sk->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('sk.edit', $sk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('sk.destroy', $sk->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#sk-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
@endpush