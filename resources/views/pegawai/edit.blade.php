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
                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="NIP" value="{{ old('nip', $pegawai->nip) }}">
                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_pengajar">Nama Pengajar</label>
                            <input type="text" name="nama_pengajar" class="form-control @error('nama_pengajar') is-invalid @enderror" id="nama_pengajar" placeholder="Nama Pengajar" value="{{ old('nama_pengajar', $pegawai->nama_pengajar) }}">
                            @error('nama_pengajar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}">
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="golongan_id">Golongan</label>
                            <select name="golongan_id" id="golongan_id" class="form-control @error('golongan_id') is-invalid @enderror">
                                @foreach($golongan as $item)
                                    <option value="{{ $item->id }}" {{ old('golongan_id', $pegawai->golongan_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('golongan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jp">Tarif JP</label>
                            <select name="jp" id="jp" class="form-control @error('jp') is-invalid @enderror">
                                <option value="">Pilih Salah Satu</option>
                                <option value="300000" {{ old('jp', $pegawai->jp) == '300000' ? 'selected' : '' }}>300000</option>
                                <option value="1000000" {{ old('jp', $pegawai->jp) == '1000000' ? 'selected' : '' }}>1000000</option>
                            </select>
                            @error('jp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pajak">Pajak</label>
                            <input type="text" name="pajak" class="form-control @error('pajak') is-invalid @enderror" id="pajak" placeholder="Pajak" value="{{ old('pajak', $pegawai->pajak) }}">
                            @error('pajak')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" value="{{ old('alamat', $pegawai->alamat) }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>    

                        <!-- Buttons -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection