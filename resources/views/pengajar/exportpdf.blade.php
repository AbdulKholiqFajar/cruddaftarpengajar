<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="box">
            <div class="box-header">
               <center> DAFTAR PENGAJAR </center>
               <br>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pengajar</th>
                            <th>Jabatan</th>
                            <th>Golongan</th> 
                            <th>Honor</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($pengajar as $item)
                        @php
                            $no++;
                            $formattedHonor = number_format($item->honor, 0, ',', '.'); // Format honor
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $item->nip }}</td>
                            <td>{{ $item->nama_pengajar }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->golongan->nama }}</td>
                            <td>{{ $formattedHonor }}</td> <!-- Display formatted honor -->
                            <td>{{ $item->alamat }}</td>    
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
