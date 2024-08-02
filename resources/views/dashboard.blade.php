@extends('layouts.admin')

@section('title')
   Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$pegawaiCount}}</h3>
                <p>Total Pengajar</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{route('pegawai.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$mapelCount}}</h3>
                <p>Total Mata Pelatihan</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="{{ route('mata_pelatihans.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
            <h3>{{$suratCount}}</h3>
            <p>Total Surat Keputusan</p>
            </div>
            <div class="icon">
                <i class="fa fa-file"></i>
            </div>
            <a href="{{ route('suratkeputusan.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endsection