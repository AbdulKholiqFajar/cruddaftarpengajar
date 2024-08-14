@extends('layouts.admin')

@section('title')
    Detail Pengajar
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pengajar</h3>
                    <div class="card-tools">
                        <a href="{{ route('pengajar.index') }}" class="btn btn-secondary btn-sm">
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
                                <p id="nip">{{ $pengajar->nip }}</p>
                            </div>
                            <div class="form-group">
                                <label for="nama_pengajar">Nama Pengajar:</label>
                                <p id="nama_pengajar">{{ $pengajar->nama_pengajar }}</p>
                            </div>
                            <div class="form-group">
                                <label for="golongan">Golongan:</label>
                                <p id="golongan">{{ $pengajar->golongan ? $pengajar->golongan->nama : 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="honor">Honor:</label>
                                <p id="honor">{{ number_format($pengajar->honor) }}</p>
                            </div>
                            <div class="form-group">
                                <label for="pajak">Pajak:</label>
                                <p id="pajak">{{ number_format($pengajar->pajak) }}</p>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <p id="alamat">{{ $pengajar->alamat }}</p>
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