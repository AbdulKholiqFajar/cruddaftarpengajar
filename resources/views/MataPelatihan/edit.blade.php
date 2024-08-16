@extends('layouts.admin')

@section('title')
    Edit Mata Pelatihan
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Mata Pelatihan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('mata_pelatihans.update', $mata_pelatihan->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="mata_pelatihan">Mata Pelatihan</label>
                            <input type="text" id="mata_pelatihan" name="mata_pelatihan" class="form-control @error('mata_pelatihan') is-invalid @enderror" value="{{ old('mata_pelatihan', $mata_pelatihan->mata_pelatihan) }}" required>
                            @error('mata_pelatihan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jml_jp">Jumlah JP</label>
                            <input type="number" id="jml_jp" name="jml_jp" class="form-control @error('jml_jp') is-invalid @enderror" value="{{ old('jml_jp', $mata_pelatihan->jml_jp) }}" required>
                            @error('jml_jp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('mata_pelatihans.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection