@extends('layouts.admin')

@section('title')
    Edit Data
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Edit Data Pegawai
                </div>
                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="NIP" value="{{ old('nip', $pegawai->nip) }}">
                                    @error('nip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_pengajar">Nama Pengajar</label>
                                    <input type="text" name="nama_pengajar" class="form-control @error('nama_pengajar') is-invalid @enderror" id="nama_pengajar" placeholder="Nama Pengajar" value="{{ old('nama_pengajar', $pegawai->nama_pengajar) }}">
                                    @error('nama_pengajar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}">
                                    @error('jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="golongan_id">Golongan</label>
                                    <select name="golongan_id" id="golongan_id" class="form-control @error('golongan_id') is-invalid @enderror">
                                        <option value="">Pilih Golongan</option>
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
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="honor">Honor</label>
                                    <input type="text" id="honor" name="honor" class="form-control @error('honor') is-invalid @enderror" placeholder="Honor" value="{{ old('honor', number_format($pegawai->honor, 0, ',', '.')) }}">
                                    @error('honor')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="pajak">Pajak</label>
                                    <input type="text" id="pajak" name="pajak" class="form-control @error('pajak') is-invalid @enderror" placeholder="Pajak" value="{{ old('pajak', number_format($pegawai->pajak, 0, ',', '.')) }}">
                                    @error('pajak')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" value="{{ old('alamat', $pegawai->alamat) }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
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

@push('scripts')
<script>
$(document).ready(function () {
    function formatNumber(input) {
        // Hapus karakter non-angka kecuali titik desimal
        let value = input.value.replace(/[^0-9]/g, '');

        // Format angka dengan pemisah ribuan tanpa angka desimal
        input.value = value ? parseInt(value).toLocaleString() : '';
    }

    function unformatNumber(input) {
        // Hapus pemisah ribuan dan hanya simpan angka
        let value = input.value.replace(/,/g, '');
        input.value = value;
    }

    // Terapkan formatNumber setiap kali input pada pajak berubah
    $("#pajak").on('input', function () {
        formatNumber(this);
    });

    $("form").on('submit', function () {
        // Hapus pemisah ribuan sebelum mengirim data ke server
        unformatNumber($("#pajak")[0]);
    });

    // Atur nilai awal input pada halaman dimuat
    function setInitialValues() {
        let pajakInput = $("#pajak")[0];
        // Jika nilai pajak input sudah diformat (ada pemisah ribuan), hapus formatnya
        if (pajakInput.value.includes(',')) {
            unformatNumber(pajakInput);
        }
    }

    setInitialValues();
});
</script>
@endpush