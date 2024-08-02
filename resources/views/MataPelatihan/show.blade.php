@extends('layouts.admin')

@section('title')
    Detail Mata Pelatihan
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Mata Pelatihan</h3>
                    <div class="card-tools">
                        <a href="{{ route('mata_pelatihans.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_mapel">Kode Mata Pelatihan:</label>
                                <p id="kode_mapel">{{ $mata_pelatihan->kode_mapel }}</p>
                            </div>
                            <div class="form-group">
                                <label for="mata_pelatihan">Mata Pelatihan:</label>
                                <p id="mata_pelatihan">{{ $mata_pelatihan->mata_pelatihan }}</p>
                            </div>
                            <div class="form-group">
                                <label for="jml_jp">Jumlah JP:</label>
                                <p id="jml_jp">{{ $mata_pelatihan->jml_jp }}</p>
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