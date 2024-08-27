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
                            <th>NO</th>
                            <th>Mata Pelatihan</th>
                            <th>Jumlah JP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($mata_pelatihans as $item)
                        @php
                            $no++;
                            $formattedJmlJp = number_format($item->jml_jp, 0, ',', '.'); // Format Jumlah JP
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $item->mata_pelatihan }}</td>
                            <td>{{ $formattedJmlJp }}</td> <!-- Display formatted Jumlah JP -->
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
