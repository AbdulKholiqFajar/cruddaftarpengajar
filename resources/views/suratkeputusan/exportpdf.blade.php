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

                    @endphp
                    @foreach ($suratkeputusan as $item)
                    @php
                        $no++;

                    @endphp
                    <tr>
                        <td>{{ $no }}</th>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ $item->nama_pengajar }}</td>
                            <td>{{ $item->mapel }}</td>
                            <td>{{ $item->golongan ? $item->golongan->nama : 'N/A' }}</td>
                            <td>{{ $item->jml_jp }}</td>
                            <td>{{ $item->tarif_jp }}</td>
                            <td>{{ $item->jumlah_bruto }}</td>   
                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>

   </div>
     <footer class="fixed-bottom">
         <span class="blockquote-footer"> Printed by BAPEKOM IV BANDUNG </span>
     </footer>
</body>
</html>
