@extends('layouts.admin')

@section('title')
    Input Data
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Input Data Baru
                </div>
                <form action="{{ route('suratkeputusan.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="waktu">Waktu</label>
                            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" id="waktu" placeholder="Waktu" value="{{ old('waktu') }}">
                            @error('waktu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_pengajar">NAMA</label>
                            <input type="text" name="nama_pengajar" class="form-control @error('nama_pengajar') is-invalid @enderror" id="nama_pengajar" placeholder="Nama Pengajar" value="{{ old('nama_pengajar') }}">
                            @error('nama_pengajar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_pengajar">URAIAN</label>
                            <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" id="mapel" placeholder="URAIAN" value="{{ old('mapel') }}">
                            @error('mapel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="golongan_id">Golongan</label>
                            <select name="golongan_id" id="golongan_id" class="form-control @error('golongan_id') is-invalid @enderror">
                                @foreach($golongan as $item)
                                    <option value="{{ $item->id }}" {{ old('golongan_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('golongan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jml_jp">JUMLAH JP</label>
                            <input type="number" id="jml_jp" name="jml_jp" class="form-control @error('jml_jp') is-invalid @enderror" value="{{ old('jml_jp') }}" required>
                            @error('jml_jp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jp">TARIF JP</label>
                            <select name="tarif_jp" id="tarif_jp" class="form-control @error('tarif_jp') is-invalid @enderror">
                                <option value="">Pilih Salah Satu</option>
                                <option value="300000" {{ old('jp') == '300000' ? 'selected' : '' }}>300000</option>
                                <option value="1000000" {{ old('jp') == '1000000' ? 'selected' : '' }}>1000000</option>
                            </select>
                            @error('tarif_jp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pajak">JUMLAH BRUTO</label>
                            <input type="text" name="jumlah_bruto" class="form-control @error('jumlah_bruto') is-invalid @enderror" id="jumlah_bruto" placeholder="JUMLAH BRUTO" value="{{ old('jumlah_bruto') }}">
                            @error('jumlah_bruto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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