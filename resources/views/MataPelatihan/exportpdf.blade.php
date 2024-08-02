<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MataPelatihan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
    <div class="box">
        <div class="box-header">
           <center> MATA PELATIHAN </center>
           <br>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Mata Pelatihan</th>
                        <th>Mata Pelatihan</th>
                        <th>Jumlah JP</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=0;

                    @endphp
                    @foreach ($mata_pelatihans as $item)
                    @php
                        $no++;

                    @endphp
                    <tr>
                        <td>{{ $no }}</th>
                            <td>{{ $item->kode_mapel }}</td>
                            <td>{{ $item->mata_pelatihan }}</td>
                            <td>{{ $item->jml_jp }}</td>    
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
