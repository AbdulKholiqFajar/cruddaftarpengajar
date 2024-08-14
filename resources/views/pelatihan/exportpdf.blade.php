<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keputusan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        @page {
            size: A3 landscape; /* Menetapkan ukuran kertas A3 dalam orientasi landscape */
            margin: 20mm; /* Menambahkan margin jika diperlukan */
        }
        body {
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 100%;
            overflow: hidden;
            padding: 20px;
        }
        .box {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .box-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .box-body {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 12px; /* Perbesar padding jika diperlukan */
            text-align: center;
            border: 1px solid #dee2e6;
        }
        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .table tbody td {
            text-align: center;
        }
        .table tfoot td {
            text-align: center;
        }
        /* Menyesuaikan lebar kolom */
        .col-no {
            width: 5%; /* Lebar kolom no */
        }
        .col-tanggal {
            width: 10%; /* Lebar kolom tanggal */
        }
        .col-waktu {
            width: 15%; /* Lebar kolom waktu */
        }
        .col-nama {
            width: 15%; /* Lebar kolom nama */
        }
        .col-uraian {
            width: 20%; /* Lebar kolom uraian */
        }
        .col-gol {
            width: 10%; /* Lebar kolom gol */
        }
        .col-jml-jp {
            width: 10%; /* Lebar kolom jml jp */
        }
        .col-status {
            width: 10%; /* Lebar kolom jml jp */
        }
        .col-tarif-jp {
            width: 10%; /* Lebar kolom tarif jp */
        }
        .col-jumlah-bruto {
            width: 10%; /* Lebar kolom jumlah bruto */
        }
        .footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #f1f1f1;
            padding: 10px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="box">
            <div class="box-header">
                <center></center>
                <br>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-tanggal">TANGGAL</th>
                            <th class="col-waktu">WAKTU</th>
                            <th class="col-nama">NAMA</th>
                            <th class="col-uraian">URAIAN</th>
                            <th class="col-gol">GOL</th>
                            <th class="col-jml-jp">JML JP</th>
                            {{-- <th class="col-status">STATUS</th> --}}
                            <th class="col-tarif-jp">TARIF JP</th>
                            <th class="col-jumlah-bruto">JUMLAH BRUTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                            $jml_jp = 0;
                            $tarif_jp = 0;
                            $jumlah_bruto = 0;
                        @endphp
                        @foreach ($pelatihan as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</td>
                            <td>{{ $item->pengajar?->nama_pengajar }}</td>
                            <td>{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                            <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                            <td>{{ number_format($item->jml_jp) }}</td>
                            {{-- <td>
                                @if($item->approve == 2)
                                    Approved
                                @elseif($item->approve == 3)
                                    Rejected
                                @else
                                    Pending
                                @endif
                            </td> --}}
                            <td>{{ number_format($item->tarif_jp) }}</td>
                            <td>{{ number_format($item->jumlah_bruto) }}</td>
                            @php
                                $jml_jp += intval($item->jml_jp);
                                $tarif_jp += intval($item->tarif_jp);
                                $jumlah_bruto += intval($item->jumlah_bruto);
                            @endphp
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <td colspan="6" style="text-align: right;">TOTAL</td>
                        <td class="col-jml-jp">{{ number_format($jml_jp) }}</td>
                        <td class="col-status"></td> <!-- Kosongkan kolom status di footer -->
                        <td class="col-tarif-jp">{{ number_format($tarif_jp) }}</td>
                        <td class="col-jumlah-bruto">{{ number_format($jumlah_bruto) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <footer class="footer">
        <span class="blockquote-footer">Printed by BAPEKOM IV BANDUNG</span>
    </footer>
</body>
</html>