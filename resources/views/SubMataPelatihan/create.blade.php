@extends('layouts.admin')

@section('title')
    Tambah Sub Mata Pelatihan
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Sub Mata Pelatihan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <form action="{{ route('sub_mata_pelatihans.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code_sub_mata_pelatihan">Kode Sub Mata Pelatihan</label>
                            <select name="code_sub_mata_pelatihan" id="code_sub_mata_pelatihan" class="form-control @error('code_sub_mata_pelatihan') is-invalid @enderror">
                            <option value="">Pilih Kode Mata Pelatihan</option>
                            @foreach($mataPelatihan as $item)
                                <option value="{{ $item->id }}" {{ old('kode_mapel') == $item->id ? 'selected' : '' }}>{{ $item->kode_mapel }}</option>
                            @endforeach 
                            </select>
                            @error('kode_mapel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                     
                        <div class="form-group">
                            <label for="mata_pelatihan_id">Mata Pelatihan</label>
                            <select name="mata_pelatihan_id" id="mata_pelatihan_id" class="form-control @error('mata_pelatihan_id') is-invalid @enderror">
                                <option value="">Pilih Mata Pelatihan</option>
                                @foreach($mataPelatihan as $item)
                                    <option value="{{ $item->id }}" {{ old('mata_pelatihan_id') == $item->id ? 'selected' : '' }}>{{ $item->mata_pelatihan }}</option>
                                @endforeach
                            </select>
                            @error('mata_pelatihan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       
                        <div class="form-group">
                          <label for="sub_mata_pelatihan">Sub Mata Pelatihan</label>
                          <input type="text" id="sub_mata_pelatihan" name="sub_mata_pelatihan" class="form-control @error('sub_mata_pelatihan') is-invalid @enderror" value="{{ old('sub_mata_pelatihan') }}" required>
                          @error('sub_mata_pelatihan')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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