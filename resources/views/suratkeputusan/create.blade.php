@extends('layouts.admin')

@section('title')
    Buat SK
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Input Data SK Baru
            </div>
            <form action="{{ route('sk.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tanggal_sk">Tanggal SK</label>
                                <input type="date" name="tanggal_sk" class="form-control @error('tanggal_sk') is-invalid @enderror" id="tanggal_sk" value="{{ old('tanggal_sk') }}" required>
                                @error('tanggal_sk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" id="tahun" value="{{ old('tahun') }}" required>
                                @error('tahun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tentang">Tentang</label>
                                <textarea id="tentang" name="tentang" class="form-control summernote">{{ old('tentang') }}</textarea>
                                @error('tentang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="menimbang">Menimbang</label>
                                <textarea id="menimbang" name="menimbang" class="form-control summernote">{{ old('menimbang') }}</textarea>
                                @error('menimbang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="mengingat">Mengingat</label>
                                <textarea id="mengingat" name="mengingat" class="form-control summernote">{{ old('mengingat') }}</textarea>
                                @error('mengingat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="menetapkan">Menetapkan</label>
                                <textarea id="menetapkan" name="menetapkan" class="form-control summernote">{{ old('menetapkan') }}</textarea>
                                @error('menetapkan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tembusan">Tembusan</label>
                                <textarea id="tembusan" name="tembusan" class="form-control summernote">{{ old('tembusan') }}</textarea>
                                @error('tembusan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="isi">Isi</label>
                                <textarea id="isi" name="isi" class="form-control summernote">{{ old('isi') }}</textarea>
                                @error('isi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('sk.index') }}" class="btn btn-secondary">Batal</a>
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
        $('.summernote').summernote({
            height: 300,   // Set height of editor
            minHeight: null,  // Set minimum height of editor
            maxHeight: null,  // Set maximum height of editor
            focus: true,   // Set focus to editable area after initializing summernote
        });
    });
</script>
@endpush
