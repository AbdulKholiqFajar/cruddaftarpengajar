@extends('layouts.admin')

@section('title')
    Detail Surat Keputusan
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Surat Keputusan</h3>
                    <div class="card-tools">
                        <a href="{{ route('suratkeputusan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal:</label>
                                <p id="tanggal">{{ $suratkeputusan->tanggal }}</p>
                            </div>
                            <div class="form-group">
                                <label for="waktu">Waktu:</label>
                                <p id="waktu">{{ $suratkeputusan->waktu }}</p>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Pengajar:</label>
                                <p id="nama">{{ $suratkeputusan->nama_pengajar }}</p>
                            </div>
                            <div class="form-group">
                                <label for="uraian">Uraian:</label>
                                <p id="uraian">{{ $suratkeputusan->mapel }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="golongan">Golongan:</label>
                                <p id="golongan">{{ $suratkeputusan->golongan ? $suratkeputusan->golongan->nama : 'N/A' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_jp">Jumlah JP:</label>
                                <p id="jumlah_jp">{{ number_format($suratkeputusan->jml_jp) }}</p>
                            </div>
                            <div class="form-group">
                                <label for="tarif_jp">Tarif JP:</label>
                                <p id="tarif_jp">{{ number_format($suratkeputusan->tarif_jp) }}</p>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_bruto">Jumlah Bruto:</label>
                                <p id="jumlah_bruto">{{ number_format($suratkeputusan->jumlah_bruto) }}</p>
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