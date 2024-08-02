@extends('layouts.admin')

@section('title')
    Detail Pegawai
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pegawai</h3>
                    <div class="card-tools">
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nip">NIP:</label>
                                <p id="nip">{{ $pegawai->nip }}</p>
                            </div>
                            <div class="form-group">
                                <label for="nama_pengajar">Nama Pengajar:</label>
                                <p id="nama_pengajar">{{ $pegawai->nama_pengajar }}</p>
                            </div>
                            <div class="form-group">
                                <label for="golongan">Golongan:</label>
                                <p id="golongan">{{ $pegawai->golongan ? $pegawai->golongan->nama : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tarif_jp">Tarif JP:</label>
                                <p id="tarif_jp">{{ $pegawai->jp }}</p>
                            </div>
                            <div class="form-group">
                                <label for="pajak">Pajak:</label>
                                <p id="pajak">{{ $pegawai->pajak }}</p>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <p id="alamat">{{ $pegawai->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection