@extends('layouts.admin')

@section('title')
    Edit Data
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Edit Data
                </div>
                <form action="{{ route('pelatihan.update', $pelatihan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <select name="title" id="title" class="form-control  is_select {{$isPetugas ? 'readonly' : 'select2'}}">
                                        <option value="">Pilih Judul</option>
                                        @foreach($masterPelatihan as $item)
                                            <option value="{{ $item }}" {{ $pelatihan->title == $item ? 'selected' : '' }}>{{ strtoupper($item)  }}</option>
                                        @endforeach
                                    </select>
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
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tanggal" value="{{ old('tanggal', $pelatihan->tanggal) }}"  {{$isPetugas ? 'readonly' : ''}}>
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
                                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" placeholder="Waktu Awal" value="{{ old('start_time', $pelatihan->start_time) }}"  {{$isPetugas ? 'readonly' : ''}}>
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
                                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" placeholder="Waktu Akhir" value="{{ old('end_time', $pelatihan->end_time) }}"  {{$isPetugas ? 'readonly' : ''}}>
                                    @error('end_time')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nama_pengajar">NAMA</label>
                                    <select name="nama_pengajar" id="nama_pengajar" class="form-control @error('nama_pengajar') is-invalid @enderror  {{$isPetugas ? 'readonly' : ''}}">
                                        <option value="">Pilih Pengajar</option>
                                        @foreach($pengajar as $item)
                                            <option value="{{ $item->id }}" {{ old('nama_pengajar', $pelatihan->pengajar_id) == $item->id ? 'selected' : '' }}>{{ $item->nama_pengajar }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_pengajar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="mapel">URAIAN</label>
                                    <select name="mapel" id="mapel" class="form-control @error('mapel') is-invalid @enderror {{$isPetugas ? 'readonly' : ''}}">
                                        <option value="">Pilih URAIAN</option>
                                        @foreach($mataPelatihan as $item)
                                            <option value="{{ $item->id }}" {{ old('mapel', $pelatihan->mata_pelatihan_id) == $item->id ? 'selected' : '' }}>{{ $item->mata_pelatihan }}</option>
                                        @endforeach
                                    </select>
                                    @error('mapel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="golongan_id">Golongan</label>
                                    <select name="golongan_id" id="golongan_id" class="form-control @error('golongan_id') is-invalid @enderror {{$isPetugas ? 'readonly' : ''}}">
                                        <option value="">Pilih Golongan</option>
                                        @foreach($golongan as $item)
                                            <option value="{{ $item->nama }}" {{ old('golongan_id', $pelatihan->golongan_id) == $item->nama ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('golongan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="jml_jp">JUMLAH JP</label>
                                    <input type="text" id="jml_jp" name="jml_jp" class="form-control @error('jml_jp') is-invalid @enderror" placeholder="Jumlah JP" value="{{ number_format($pelatihan->jml_jp, 2)}}" {{$isPetugas ? 'readonly' : ''}} required>
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
                                        <input type="text" name="tarif_jp" id="tarif_jp" class="form-control @error('tarif_jp') is-invalid @enderror" placeholder="Masukkan Tarif JP" value="{{ old('tarif_jp', $pelatihan->tarif_jp) }}">
                                        @error('tarif_jp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="jumlah_bruto">JUMLAH BRUTO</label>
                                        <input type="text" name="jumlah_bruto" class="form-control @error('jumlah_bruto') is-invalid @enderror" id="jumlah_bruto" placeholder="JUMLAH BRUTO" value="{{ old('jumlah_bruto', $pelatihan->jumlah_bruto) }}">
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        // Inisialisasi Select2 untuk nama_pengajar dan mapel
        $('#nama_pengajar').select2({
            placeholder: 'Pilih Pengajar',
            allowClear: true
        });

        $('#mapel').select2({
            placeholder: 'Pilih Mata Pelatihan',
            allowClear: true
        });

        function formatNumberWithoutDecimal(value) {
            return parseFloat(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function formatInputs() {
            let tarif_jp = $("#tarif_jp").val().replace(/,/g, '');
            let jml_jp = $("#jml_jp").val().replace(/,/g, '');

            tarif_jp = tarif_jp ? parseFloat(tarif_jp) : 0;
            jml_jp = jml_jp ? parseFloat(jml_jp) : 0;

            $("#tarif_jp").val(formatNumberWithoutDecimal(tarif_jp));
            $("#jml_jp").val(formatNumberWithoutDecimal(jml_jp));

            calculateJumlahBruto();
        }

        function calculateJumlahBruto() {
            let tarif_jp = $("#tarif_jp").val().replace(/,/g, '');
            let jml_jp = $("#jml_jp").val().replace(/,/g, '');
            tarif_jp = tarif_jp ? parseFloat(tarif_jp) : 0;
            jml_jp = jml_jp ? parseFloat(jml_jp) : 0;

            let jml_bruto = jml_jp * tarif_jp;
            $("#jumlah_bruto").val(formatNumberWithoutDecimal(jml_bruto));
        }

        $("#nama_pengajar").on('change', function () {
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

        $("#mapel").on('change', function () {
            var mataPelatihanId = $(this).val();
            if (mataPelatihanId) {
                $.ajax({
                    url: '/mata_pelatihan/' + mataPelatihanId,
                    method: 'GET',
                    success: function (response) {
                        $('#jml_jp').val(formatNumberWithoutDecimal(response.jml_jp));
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

        $("#tarif_jp").on('input', calculateJumlahBruto);
        $("#jml_jp").on('input', calculateJumlahBruto);

        formatInputs();
    });
</script>
@endpush
