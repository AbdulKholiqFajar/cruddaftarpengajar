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
                                            <label for="title">Judul <span style="color: red">*</span></label>
                                            <select name="title" id="title" class="form-control select2">
                                                <option value="">Pilih Judul</option>
                                                @foreach($masterPelatihan as $item)
                                                    <option value="{{ $item }}" {{ @$data['title'] == $item ? 'selected' : '' }}>{{ strtoupper($item) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-12 text-right mt-2">
                                            <a href="{{route('pelatihan.index')}}" class="btn btn-warning waves-effect waves-light" id="btn-reset">Reset</a>
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

    <!-- Filter Form -->
    

    <div class="row">
        <div class="col-12">
            @if($pelatihan)
            <div class="card">
                <div class="card-header">
                    {{-- <h3 class="card-title">Detail Pelatihan</h3> --}}
                    <div class="card-tools">
                        @can('penyelenggara-export')
                        <a href="{{ route('export.surat.pdf', ['title' => $pelatihan->title]) }}" class="btn btn-danger btn-sm ml-3">
                            <i class="fa fa-file-pdf"></i> Export PDF
                        </a>
                        @endcan
                        
                    </div>
                </div>
                <div class="card-body mt-2">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th colspan="11">{{strtoupper($pelatihan?->title)}}</th>
                                            </tr>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>JP</th>
                                                <th>Mata Pelatihan</th>
                                                <th>Nama Pengajar</th>
                                                <th>Gol</th>
                                                <th>JUMLAH JP</th>
                                                <th>TARIF JP</th>
                                                <th>JUMLAH BRUTO</th>
                                                <th>Status</th>
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
                                                        <td>{{ number_format($item->jml_jp) }}</td>
                                                        <td>{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                                                        <td>{{ $item->pengajar?->nama_pengajar }}</td>
                                                        <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                                        <td>{{ number_format($item->jml_jp) }}</td>
                                                        <td>{{ number_format($item->tarif_jp) }}</td>
                                                        <td>{{ number_format($item->jumlah_bruto) }}</td>
                                                        <td>
                                                            <form id="status-form-{{ $item->id }}" action="{{ route('pelatihan.updateStatus', $item->id) }}" method="POST" class="status-form">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <select name="status" class="form-control" onchange="updateStatus({{ $item->id }}, this)">
                                                                        <option value="" disabled selected>Pilih Status</option>
                                                                        <option value="approved" {{ $item->approve == 2 ? 'selected' : '' }}>✔️</option>
                                                                        <option value="rejected" {{ $item->approve == 3 ? 'selected' : '' }}>❌</option>
                                                                    </select>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Setting
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a href="{{ route('pelatihan.show', $item->id) }}" class="dropdown-item">
                                                                        <i class="fa fa-eye"></i> Detail
                                                                    </a>
                                                                    <a href="{{ route('pelatihan.edit', $item->id) }}" class="dropdown-item">
                                                                        <i class="fa fa-edit"></i> Edit
                                                                    </a>
                                                                    <form action="{{ route('pelatihan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger">
                                                                            <i class="fa fa-trash"></i> Delete
                                                                        </button>
                                                                    </form>
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
                                            <th colspan="6" style="text-align: center;">TOTAL</th>
                                            <th class="col-jml-jp">{{ number_format($jml_jp) }}</th>
                                            <th class="col-tarif-jp">{{ number_format($tarif_jp) }}</th>
                                            <th class="col-jumlah-bruto">{{ number_format($jumlah_bruto) }}</th>
                                            <th colspan="2" style="text-align: center;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
            </div>
            @else
                <h3 class="text-center mt-5">Data Tidak Ada</h3>
            @endif
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#nama_pengajar').on('change', function () {
                var pengajarId = $(this).val();
                if (pengajarId) {
                    $.ajax({
                        url: '/pengajar/' + pengajarId + '/golongan',
                        method: 'GET',
                        success: function (response) {
                            $('#golongan_id').val(response.golongan);
                        },
                        error: function () {
                            $('#golongan_id').val('');
                        }
                    });
                } else {
                    $('#golongan_id').val('');
                }
            });
            $('#nama_pengajar').trigger('change');
        });
        function updateStatus(id, selectElement) {
            var form = document.getElementById('status-form-' + id);
            var formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                } else {
                    Swal.fire('Gagal!', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Terjadi kesalahan saat mengubah status.', 'error');
                console.error('Error:', error);
            });
        }

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
                    "lengthMenu": "Show _MENU_ entri"
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
                            url: '/pelatihan/' + id,
                            data: {
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                ).then(() => {
                                    // Redirect to index page
                                    window.location.href = '{{ route('pelatihan.index') }}';
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