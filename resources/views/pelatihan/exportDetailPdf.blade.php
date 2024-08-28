<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 20mm;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin: 10px 0;
            border: none; /* Pastikan tidak ada border */
            padding: 0;
        }
        table {
            width: 115%;
            border-collapse: collapse;
            table-layout: fixed; /* Memastikan lebar kolom tetap sesuai dengan lebar yang ditentukan */
        }
        th, td {
            padding: 8px;
            text-align: center; /* Menyelaraskan teks ke tengah secara horizontal */
            border: 1px solid #000;
            vertical-align: middle; /* Menyelaraskan teks ke tengah secara vertikal */
        }
        th {
            background-color: #ffffff; /* Mengubah warna latar belakang header menjadi putih */
            font-weight: bold;
        }
        .no-date {
            background-color: #ffffff; /* Mengubah warna latar belakang kolom tanggal menjadi putih */
        }
        tfoot th {
            font-weight: bold;
            text-align: center; /* Memastikan teks TOTAL berada di tengah */
        }
        /* Menyesuaikan lebar kolom */
        .col-no {
            width: 3%; /* Lebar kolom no yang lebih kecil */
        }
        .col-tanggal {
            width: 11%; /* Lebar kolom tanggal */
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
            width: 7%; /* Lebar kolom jml jp */
        }
        .col-tarif-jp {
            width: 10%; /* Lebar kolom tarif jp */
        }
        .col-jumlah-bruto {
            width: 10%; /* Lebar kolom jumlah bruto */
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th class="col-no">NO</th>
                <th class="col-tanggal">TANGGAL</th>
                <th class="col-waktu">WAKTU</th>
                <th class="col-nama">NAMA</th>
                <th class="col-uraian">URAIAN</th>
                <th class="col-gol">GOL</th>
                <th class="col-jml-jp">JML JP</th>
                <th class="col-tarif-jp">TARIF JP</th>
                <th class="col-jumlah-bruto">JUMLAH BRUTO</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $totalJmlJp = 0;
                $totalTarifJp = 0;
                $totalJumlahBruto = 0;
                $previousDate = null;
            @endphp
            @foreach ($groupPelatihan as $tanggal => $pelatihans)
                @php
                    $pelatihans = $pelatihans->sortBy('start_time');
                    $tanggalFormatted = \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y');
                @endphp
                @foreach ($pelatihans as $item)
                    @php
                        $totalJmlJp += floatval($item->jml_jp);
                        $totalTarifJp += floatval($item->tarif_jp);
                        $totalJumlahBruto += floatval($item->jumlah_bruto);
                        $isNewDate = $previousDate !== $tanggal;
                    @endphp
                    <tr>
                        @if ($isNewDate)
                            <td class="col-no" rowspan="{{ count($pelatihans) }}" >{{ $no }}</td>
                            <td class="col-tanggal no-date" rowspan="{{ count($pelatihans) }}">{{ $tanggalFormatted }}</td>
                            @php
                                $previousDate = $tanggal;
                                $no++;
                            @endphp
                        @endif
                        <td class="col-waktu">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</td>
                        <td class="col-nama">{{ $item->pengajar?->nama_pengajar }}</td>
                        <td class="col-uraian">{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                        <td class="col-gol">{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                        <td class="col-jml-jp">{{ fmod($item->jml_jp, 1) !== 0.00 ? number_format($item->jml_jp, 2, ',', '.') : number_format($item->jml_jp, 0, ',', '.') }}</td>
                        <td class="col-tarif-jp">{{ number_format(floatval($item->tarif_jp), 0, '', ',') }}</td>
                        <td class="col-jumlah-bruto">{{ number_format(floatval($item->jumlah_bruto), 0, '', ',') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6">TOTAL</th>
                <th class="col-jml-jp">{{ number_format($totalJmlJp, 0, '', ',') }}</th>
                <th class="col-tarif-jp">{{ number_format($totalTarifJp, 0, '', ',') }}</th>
                <th class="col-jumlah-bruto">{{ number_format($totalJumlahBruto, 0, '', ',') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>