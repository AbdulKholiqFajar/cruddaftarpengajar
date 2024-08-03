<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>suratkeputusan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
    <div class="box">
        <div class="box-header">
           <center> DAFTAR PENCERAMAH, PENGAJAR, FASILITATOR PRAKTIKUM </center>
           <br>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>TANGGAL</th>
                        <th>WAKTU</th>
                        <th>NAMA</th>
                        <th>URAIAN</th>
                        <th>GOL</th>
                        <th>JML JP</th>
                        <th>TARIF JP</th>
                        <th>JUMLAH BRUTO</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=0;
                        $jml_jp=0;
                        $tarif_jp=0;
                        $jumlah_bruto=0;

                    @endphp
                    @foreach ($suratkeputusan as $item)
                    @php
                        $no++;

                    @endphp
                    <tr>
                        <td>{{ $no }}</th>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y'), }}</td>
                            <td>{{ $item->start_time.' - '.$item->end_time }}</td>
                            <td>{{ $item->pegawai?->nama_pengajar }}</td>
                            <td>{{ $item->mata_pelatihan?->mata_pelatihan }}</td>
                            <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                            <td>{{ number_format($item->jml_jp) }}</td>
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
                  <td colspan="7" style="text-align: right">Total : {{ number_format($jml_jp) }}</td>
                  <td style="">Total  {{ number_format($tarif_jp) }}</td>
                  <td style="">Total : {{ number_format($jumlah_bruto) }}</td>
                </tfoot>
            </table>
        </div>
    </div>

   </div>
     <footer class="fixed-bottom">
         <span class="blockquote-footer"> Printed by BAPEKOM IV BANDUNG </span>
     </footer>
</body>
</html>
