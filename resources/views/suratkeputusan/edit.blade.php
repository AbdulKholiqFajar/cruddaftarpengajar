@extends('layouts.admin')

@section('title')
    Edit Data SK
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Edit Data SK
            </div>
            <form action="{{ route('sk.update', $sk->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nomor_sk">Nomor SK</label>
                                <input type="text" name="nomor_sk" class="form-control" id="nomor_sk" value="{{ old('nomor_sk', $sk->nomor_sk) }}" readonly>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tanggal_sk">Tanggal SK</label>
                                <input type="date" name="tanggal_sk" class="form-control @error('tanggal_sk') is-invalid @enderror" id="tanggal_sk" value="{{ old('tanggal_sk', $sk->tanggal_sk->format('Y-m-d')) }}" required>
                                @error('tanggal_sk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tentang">Tentang</label>
                                <textarea id="tentang" name="tentang" class="form-control summernote">{{ old('tentang', $sk->tentang) }}</textarea>
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
                                <textarea id="menimbang" name="menimbang" class="form-control summernote">{{ old('menimbang', $sk->menimbang) }}</textarea>
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
                                <textarea id="mengingat" name="mengingat" class="form-control summernote">{{ old('mengingat', $sk->mengingat) }}</textarea>
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
                                <textarea id="menetapkan" name="menetapkan" class="form-control summernote">{{ old('menetapkan', $sk->menetapkan) }}</textarea>
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
                                <textarea id="tembusan" name="tembusan" class="form-control summernote">{{ old('tembusan', $sk->tembusan) }}</textarea>
                                @error('tembusan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    <!-- Buttons -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
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
            focus: true, 
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]  // Atur tinggi editor sesuai kebutuhan
        });
    });
</script>
@endpush