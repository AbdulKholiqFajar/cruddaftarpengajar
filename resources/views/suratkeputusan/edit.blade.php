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
                <form action="{{ route('suratkeputusan.update', $suratkeputusan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tanggal" value="{{ $suratkeputusan->tanggal }}">
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
                                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" placeholder="Waktu Awal" value="{{ $suratkeputusan->start_time }}">
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
                                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" placeholder="Waktu Akhir" value="{{ $suratkeputusan->end_time }}">
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
                                    <select name="nama_pengajar" id="nama_pengajar" class="form-control @error('nama_pengajar') is-invalid @enderror">
                                        <option value="">Pilih Pengajar</option>
                                        @foreach($pegawai as $item)
                                            <option value="{{ $item->id }}" {{ $suratkeputusan->pegawai_id == $item->id ? 'selected' : '' }}>{{ $item->nama_pengajar }}</option>
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
                                    <label for="nama_pengajar">URAIAN</label>
                                    <select name="mapel" id="mapel" class="form-control @error('mapel') is-invalid @enderror">
                                        <option value="">Pilih URAIAN</option>
                                        @foreach($mataPelatihan as $item)
                                            <option value="{{ $item->id }}" {{ $suratkeputusan->mata_pelatihan_id == $item->id ? 'selected' : '' }}>{{ $item->mata_pelatihan }}</option>
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
                                    <select name="golongan_id" id="golongan_id" class="form-control @error('golongan_id') is-invalid @enderror">
                                        <option value="">Pilih Golongan</option>
                                        @foreach($golongan as $item)
                                            <option value="{{ $item->id }}" {{$suratkeputusan->golongan_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
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
                                    <input type="text" id="jml_jp" name="jml_jp" class="form-control currency @error('jml_jp') is-invalid @enderror" placeholder="Jumlah JP" value="{{ number_format($suratkeputusan->jml_jp) }}" required>
                                    @error('jml_jp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="jp">TARIF JP</label>
                                    <select name="tarif_jp" id="tarif_jp" class="form-control @error('tarif_jp') is-invalid @enderror">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="300000" {{ intval($suratkeputusan->tarif_jp) == '300000' ? 'selected' : '' }}>{{ number_format(300000) }}</option>
                                        <option value="1000000" {{ intval($suratkeputusan->tarif_jp) == '1000000' ? 'selected' : '' }}>{{ number_format(1000000) }}</option>
                                    </select>
                                    @error('tarif_jp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="pajak">JUMLAH BRUTO</label>
                                    <input type="text" name="jumlah_bruto" class="form-control @error('jumlah_bruto') is-invalid @enderror" id="jumlah_bruto" placeholder="JUMLAH BRUTO" value="{{ number_format($suratkeputusan->jumlah_bruto)}}">
                                    @error('jumlah_bruto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Buttons -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('suratkeputusan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            function calculateJumlahBruto() {
                let tarif_jp = $("#tarif_jp").val();
                let jml_jp = $("#jml_jp").val();
                // Pastikan jml_jp dan tarif_jp adalah angka, jika tidak, tetapkan sebagai 0
                tarif_jp = tarif_jp ? parseInt(tarif_jp) : 0;
                jml_jp = jml_jp ? parseInt(jml_jp) : 0;
                if(jml_jp == ''){
                    alert('Jumlah JP Wajib Diisi')
                }else{
                    let jml_bruto = parseInt(jml_jp) * parseInt(tarif_jp);
                    $("#jumlah_bruto").val(parseInt(jml_bruto, 10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
            }

            $("#tarif_jp").on('change', calculateJumlahBruto);
            $("#jml_jp").on('input', calculateJumlahBruto);
        });
    </script>
@endpush