@extends('layouts.admin')

@section('title')
    Tambah Data Pelatihan
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Input Data Baru
                </div>
                <form action="{{ route('pelatihan.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title" class="d-flex">
                                        Pelatihan
                                        <div class="form-check ml-3">
                                            <input class="form-check-input" type="checkbox" id="is_new" name="is_new" value="1">
                                            <label class="form-check-label">Tambah Pelatihan Baru</label>
                                        </div>
                                    </label>
                                    <select name="title_select" id="title" class="form-control is_select select2">
                                        <option value="">Pilih Pelatihan</option>
                                        @foreach($masterPelatihan as $item)
                                            <option value="{{ $item }}" {{ @$data['title'] == $item ? 'selected' : '' }}>{{ strtoupper($item) }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="title_input" class="form-control is_input hidden @error('title') is-invalid @enderror" id="title" placeholder="Pelatihan" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tanggal" value="{{ old('tanggal') }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="start_time">Waktu Awal</label>
                                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" placeholder="Waktu Awal" value="{{ old('start_time') }}">
                                    @error('start_time')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="end_time">Waktu Akhir</label>
                                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" placeholder="Waktu Akhir" value="{{ old('end_time') }}">
                                    @error('end_time')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="nama_pengajar">NAMA</label>
                                    <select name="nama_pengajar" id="nama_pengajar" class="form-control @error('nama_pengajar') is-invalid @enderror">
                                        <option value="">Pilih Pengajar</option>
                                        @foreach($pengajar as $item)
                                            <option value="{{ $item->id }}" {{ old('nama_pengajar') == $item->id ? 'selected' : '' }}>{{ $item->nama_pengajar }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_pengajar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="mapel">MATA PELATIHAN</label>
                                    <select name="mapel" id="mapel" class="form-control @error('mapel') is-invalid @enderror">
                                        <option value="">Pilih MATA PELATIHAN</option>
                                        @foreach($mataPelatihan as $item)
                                            <option value="{{ $item->id }}" {{ old('mapel') == $item->id ? 'selected' : '' }}>{{ $item->mata_pelatihan }}</option>
                                        @endforeach
                                    </select>
                                    @error('mapel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="golongan_id">Golongan</label>
                                    <input type="text" name="golongan_id" id="golongan_id" class="form-control @error('golongan_id') is-invalid @enderror" placeholder="Golongan" value="{{ old('golongan_id') }}">
                                    @error('golongan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Other fields here -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="jml_jp">JUMLAH JP</label>
                                    <input type="text" id="jml_jp" name="jml_jp" class="form-control @error('jml_jp') is-invalid @enderror" placeholder="Jumlah JP" value="{{ old('jml_jp') }}" required>
                                    @error('jml_jp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @can('tarifjp-not-penyelengara')
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="tarif_jp">TARIF JP</label>
                                    <input type="text" name="tarif_jp" id="tarif_jp" class="form-control @error('tarif_jp') is-invalid @enderror" placeholder="Masukkan Tarif JP" value="{{ old('tarif_jp') }}">
                                    @error('tarif_jp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="jumlah_bruto">JUMLAH BRUTO</label>
                                    <input type="text" name="jumlah_bruto" class="form-control @error('jumlah_bruto') is-invalid @enderror" id="jumlah_bruto" placeholder="JUMLAH BRUTO" value="{{ old('jumlah_bruto') }}">
                                    @error('jumlah_bruto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @endcan
                        </div>
                        
                        <!-- Buttons -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Apply Select2 to nama_pengajar and mapel select elements
            $('#nama_pengajar').select2({
                placeholder: 'Pilih Pengajar',
                allowClear: true
            });
            
            $('#mapel').select2({
                placeholder: 'Pilih Mata Pelatihan',
                allowClear: true
            });

            // Existing JS functionality
            $('#nama_pengajar').on('change', function () {
                var pengajarId = $(this).val();
                if (pengajarId) {
                    $.ajax({
                        url: '/pengajar/' + pengajarId + '/details',
                        method: 'GET',
                        success: function (response) {
                            $('#golongan_id').val(response.golongan);
                            let tarifJp = parseFloat(response.tarif_jp).toFixed(0);
                            $('#tarif_jp').val(tarifJp);
                            calculateJumlahBruto();
                        },
                        error: function () {
                            $('#golongan_id').val('');
                            $('#tarif_jp').val('');
                        }
                    });
                } else {
                    $('#golongan_id').val('');
                    $('#tarif_jp').val('');
                }
            });

            $('#mapel').on('change', function () {
                var mataPelatihanId = $(this).val();
                if (mataPelatihanId) {
                    $.ajax({
                        url: '/mata_pelatihan/' + mataPelatihanId,
                        method: 'GET',
                        success: function (response) {
                            $('#jml_jp').val(parseFloat(response.jml_jp));
                            calculateJumlahBruto();
                        },
                        error: function () {
                            $('#jml_jp').val('');
                        }
                    });
                } else {
                    $('#jml_jp').val('');
                }
            });

            function calculateJumlahBruto() {
                let tarif_jp = $("#tarif_jp").val().replace(/,/g, '');
                let jml_jp = $("#jml_jp").val();
                tarif_jp = tarif_jp ? parseInt(tarif_jp) : 0;
                jml_jp = jml_jp ? parseFloat(jml_jp) : 0;
                
                let jml_bruto = parseFloat(jml_jp) * parseInt(tarif_jp);
                $("#jumlah_bruto").val(parseInt(jml_bruto, 10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            }

            $("#tarif_jp").on('change', calculateJumlahBruto);
            $("#jml_jp").on('input', calculateJumlahBruto);

            $("#is_new").on('change', function(){
                if(this.checked){
                    $(".is_select").addClass('hidden');
                    $(".is_input").removeClass('hidden');
                    $('.is_select').select2('destroy');
                }else{
                    $(".is_input").addClass('hidden');
                    $(".is_select").removeClass('hidden');
                    $('.is_select').select2();
                }
            });
        });
    </script>
@endpush
