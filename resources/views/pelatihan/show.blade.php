@extends('layouts.admin')

@section('title')
    Detail Pelatihan
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h3 class="card-title">Detail Pelatihan</h3> --}}
                    <div class="card-tools">
                        <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('export.surat.pdf', ['title' => $pelatihan->title]) }}" class="btn btn-danger btn-sm ml-3">
                            <i class="fa fa-file-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table--responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="9">{{$pelatihan->title}}</th>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>JP</th>
                                            <th>Nama</th>
                                            <th>Mata Pelatihan</th>
                                            <th>Gol</th>
                                            <th>JUMLAH JP</th>
                                            <th>TARIF JP</th>
                                            <th>JUMLAH BRUTO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 0;
                                        $jml_jp = 0;
                                        $tarif_jp = 0;
                                        $jumlah_bruto = 0;
                                        @endphp
                                        @foreach ($grouppelatihan as $title => $items)
                                            @foreach ($items as $item)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</td>
                                                    <td>{{ number_format($item->jml_jp) }}</td>
                                                    <td>{{ $item->pengajar?->nama_pengajar }}</td>
                                                    <td>{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                                                    <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                                    <td>{{ number_format($item->jml_jp) }}</td>
                                                    <td>{{ number_format($item->tarif_jp) }}</td>
                                                    <td>{{ number_format($item->jumlah_bruto) }}</td>
                                                </tr>
                                                @php
                                                $jml_jp += intval($item->jml_jp);
                                                $tarif_jp += intval($item->tarif_jp);
                                                $jumlah_bruto += intval($item->jumlah_bruto);
                                                @endphp
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th colspan="6" style="text-align: center;">TOTAL</th>
                                        <th class="col-jml-jp">{{ number_format($jml_jp) }}</th>
                                        <th class="col-tarif-jp">{{ number_format($tarif_jp) }}</th>
                                        <th class="col-jumlah-bruto">{{ number_format($jumlah_bruto) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
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