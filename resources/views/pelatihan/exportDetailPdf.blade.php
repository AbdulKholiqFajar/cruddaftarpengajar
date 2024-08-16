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
            padding: 8px; /* Perbesar padding jika diperlukan */
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
            width: 3%; /* Lebar kolom no yang lebih kecil */
        }
        .col-tanggal {
            width: 12%; /* Lebar kolom tanggal */
        }
        .col-waktu {
            width: 10%; /* Lebar kolom waktu yang lebih kecil */
        }
        .col-nama {
            width: 15%; /* Lebar kolom nama */
        }
        .col-uraian {
            width: 18%; /* Lebar kolom uraian */
        }
        .col-gol {
            width: 4%; /* Lebar kolom gol yang lebih kecil */
        }
        .col-jml-jp {
            width: 4%; /* Lebar kolom jml jp yang lebih kecil */
        }
        .col-status {
            width: 10%; /* Lebar kolom status */
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
                            <th colspan="10">{{strtoupper($title)}}</th>
                        </tr>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-tanggal">Tanggal</th>
                            <th class="col-waktu">Waktu</th>
                            <th class="col-jml-jp">JP</th>
                            <th class="col-nama">Nama Pengajar</th>
                            <th class="col-uraian">Mata Pelatihan</th>
                            <th class="col-gol">Gol</th>
                            <th class="col-jml-jp">JUMLAH JP</th>
                            <th class="col-tarif-jp">TARIF JP</th>
                            <th class="col-jumlah-bruto">JUMLAH BRUTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1; // Mulai dari 1
                        $jml_jp = 0;
                        $tarif_jp = 0;
                        $jumlah_bruto = 0;
                        @endphp
                        @foreach ($groupPelatihan as $title => $items)
                            @foreach ($items as $item)
                                <tr>
                                    <td class="col-no">{{ $no++ }}</td> <!-- Increment variabel $no -->
                                    <td class="col-tanggal">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                    <td class="col-waktu">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</td>
                                    <td class="col-jml-jp">{{ number_format($item->jml_jp) }}</td>
                                    <td class="col-nama">{{ $item->pengajar?->nama_pengajar }}</td>
                                    <td class="col-uraian">{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                                    <td class="col-gol">{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                    <td class="col-jml-jp">{{ number_format($item->jml_jp) }}</td>
                                    <td class="col-tarif-jp">{{ number_format($item->tarif_jp) }}</td>
                                    <td class="col-jumlah-bruto">{{ number_format($item->jumlah_bruto) }}</td>
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
                            <th colspan="7" style="text-align: center;">TOTAL</th>
                            <th class="col-jml-jp">{{ number_format($jml_jp) }}</th>
                            <th class="col-tarif-jp">{{ number_format($tarif_jp) }}</th>
                            <th class="col-jumlah-bruto">{{ number_format($jumlah_bruto) }}</th>
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