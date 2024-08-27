@extends('layouts.admin')

@section('title')
    Daftar Pelatihan
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success d-block">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading active" role="tab" id="headingOne">
                            <div class="card-header">
                                <h4 class="panel-title">
                                    <button class="btn waves-effect btn-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Filter Data
                                    </button>
                                    @can('pelatihan-create')
                                        <a href="{{ route('pelatihan.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah Data</a>
                                    @endcan
                                </h4>
                            </div>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                            <form action="{{ route('pelatihan.index') }}" method="GET" class="mb-3">
                                <div class="card-body">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="start_date">Tanggal Awal</label>
                                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="end_date">Tanggal Akhir</label>
                                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="title">Pelatihan <span style="color: red">*</span></label>
                                                <select name="title" id="title" class="form-control select2">
                                                    <option value="">Pilih Pelatihan</option>
                                                    @foreach($masterPelatihan as $item)
                                                        <option value="{{ $item }}" {{ request('title') == $item ? 'selected' : '' }}>{{ strtoupper($item) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 text-right mt-2">
                                                <a href="{{ route('pelatihan.index') }}" class="btn btn-warning waves-effect waves-light" id="btn-reset">Reset</a>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-filter">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if($pelatihan)
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            @can('penyelenggara-export')
                                <a href="{{ route('export.surat.pdf', ['title' => $pelatihan->title]) }}" class="btn btn-danger btn-sm ml-3">
                                    <i class="fa fa-file-pdf"></i> Export PDF
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body mt-2">
                        <div class="table-responsive">
                            <table id="pelatihanTable" class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9">{{ strtoupper($pelatihan->title) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Mata Pelatihan</th>
                                        <th>Nama Pengajar</th>
                                        <th>Gol</th>
                                        <th>Jumlah JP</th>
                                        <th>Tarif JP</th>
                                        <th>Jumlah Bruto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 0;
                                    $jml_jp = 0;
                                    $tarif_jp = 0;
                                    $jumlah_bruto = 0;
                                    @endphp
                                    @foreach ($grouppelatihan as $title => $items)
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</td>
                                                <td>{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                                                <td>{{ $item->pengajar?->nama_pengajar }}</td>
                                                <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                                <td>{{ number_format($item->jml_jp) }}</td>
                                                <td>{{ number_format($item->tarif_jp) }}</td>
                                                <td>{{ number_format($item->jumlah_bruto) }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Setting
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('pelatihan.edit', $item->id) }}" class="dropdown-item">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            @can('pelatihan-delete', $item)
                                                                <form action="{{ route('pelatihan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Kamu yakin ingin menghapus item ini?');" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger">
                                                                        <i class="fa fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                            $jml_jp += intval($item->jml_jp);
                                            $tarif_jp += intval($item->tarif_jp);
                                            $jumlah_bruto += intval($item->jumlah_bruto);
                                            @endphp
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align: center;">TOTAL</th>
                                        <th>{{ number_format($jml_jp) }}</th>
                                        <th>{{ number_format($tarif_jp) }}</th>
                                        <th>{{ number_format($jumlah_bruto) }}</th>
                                        <th></th> <!-- Kosongkan cell di kolom terakhir -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <h3 class="text-center mt-5">Data Tidak Ada</h3>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#pelatihanTable').DataTable({
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
                    "lengthMenu": "Tampilkan _MENU_ entri"
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
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/pelatihan/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Data telah dihapus.',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
