<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        @page {
            size: F4 landscape;
            margin: 20mm;
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
            padding: 12px;
            text-align: center;
            border: 1px solid #000000; /* Black border for all cells */
            background-color: #ffffff; /* White background for all cells */
            color: #000000; /* Black text for all cells */
        }
        .table thead th {
            font-weight: bold;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .table tfoot td {
            font-weight: bold;
        }
        .col-no {
            width: 5%;
            vertical-align: middle;
            text-align: center; /* Center the text in the NO column */
        }
        .col-tanggal {
            width: 15%;
        }
        .col-waktu {
            width: 20%;
        }
        .col-nama {
            width: 30%;
        }
        .col-uraian {
            width: 20%;
        }
        .col-gol {
            width: 10%;
        }
        .col-jml-jp {
            width: 10%;
        }
        .col-tarif-jp {
            width: 10%;
        }
        .col-jumlah-bruto {
            width: 10%;
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
        .no-date {
            background-color: #ffffff; /* White background for date cells */
            vertical-align: middle;
            text-align: center;
        }
        .merge-cell {
            border: 1px solid #ffffff; /* Hide border for merged cells */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="box">
            <div class="box-header">
                <h6>{{ $title }}</h6>
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
                        @endphp
                        @foreach ($groupPelatihan as $tanggal => $pelatihans)
                            @php
                                $pelatihans = $pelatihans->sortBy('start_time');
                                $tanggalFormatted = \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y');
                                $first = true;
                            @endphp
                            @foreach ($pelatihans as $item)
                                <tr>
                                    @if ($first)
                                        <td class="col-no merge-cell" rowspan="{{ count($pelatihans) }}">{{ $no }}</td>
                                        <td class="col-tanggal merge-cell" rowspan="{{ count($pelatihans) }}">{{ $tanggalFormatted }}</td>
                                        @php $first = false; @endphp
                                    @endif
                                    <td>{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</td>
                                    <td>{{ $item->pengajar?->nama_pengajar }}</td>
                                    <td>{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                                    <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                                    <td>{{ rtrim(number_format(floatval($item->jml_jp), 0, '', ','), ',') }}</td>
                                    <td>{{ rtrim(number_format(floatval($item->tarif_jp), 0, '', ','), ',') }}</td>
                                    <td>{{ rtrim(number_format(floatval($item->jumlah_bruto), 0, '', ','), ',') }}</td>
                                </tr>
                                @php
                                    $totalJmlJp += floatval($item->jml_jp);
                                    $totalTarifJp += floatval($item->tarif_jp);
                                    $totalJumlahBruto += floatval($item->jumlah_bruto);
                                    if ($loop->last) $no++;
                                @endphp
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6" style="text-align: center;">TOTAL</th>
                            <th class="col-jml-jp">{{ rtrim(number_format($totalJmlJp, 0, '', ','), ',') }}</th>
                            <th class="col-tarif-jp">{{ rtrim(number_format($totalTarifJp, 0, '', ','), ',') }}</th>
                            <th class="col-jumlah-bruto">{{ rtrim(number_format($totalJumlahBruto, 0, '', ','), ',') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{-- <footer class="footer">
        <span class="blockquote-footer">Printed by BAPEKOM IV BANDUNG</span>
    </footer> --}}
</body>
</html>