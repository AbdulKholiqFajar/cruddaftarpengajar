@extends('layouts.admin')

@section('title')
    Detail Sub Mata Pelatihan
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Sub Mata Pelatihan</h3>
                    <div class="card-tools">
                        <a href="{{ route('sub_mata_pelatihans.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mata_pelatihan_id">Mata Pelatihan:</label>
                                <p id="mata_pelatihan_id">{{ $sub_mata_pelatihans->mata_pelatihan->mata_pelatihan }}</p>
                            </div>
                            <div class="form-group">
                                <label for="sub_mata_pelatihan">Sub Mata Pelatihan:</label>
                                <p id="sub_mata_pelatihan">{{ $sub_mata_pelatihans->sub_mata_pelatihan }}</p>
                            </div>
                            <div class="form-group">
                                <label for="code_sub_mata_pelatihan">Kode Mata Pelatihan:</label>
                                <p id="code_sub_mata_pelatihan">{{ $sub_mata_pelatihans->code_sub_mata_pelatihan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection