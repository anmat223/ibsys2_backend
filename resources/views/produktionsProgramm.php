<!-- erste seite: vertriebsprogramm
    forecast in xml ist für nächte Woche
drunter produktionsprogramm-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Vertriebsprogramm fuer die naechste Woche:</title>
</head>

<body>
    <h1>Vertriebsprogramm für die nächste Woche</h1>
    <div>
        <?php        
        require '../../classes/services/XML_Reader_Service.php';
        $XML_Reader = new XML_Reader_Service();
        $forecastsNextWeek = $XML_Reader->get_forecast();        
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" data-editable="true">Produkt</th>
                    <th scope="col"> Anzahl Aufträge</th>
                </tr>
            </thead>
            <tbody>                
                    <tr>
                        <th scope="row">P1</th>
                        <td><?php echo $forecastsNextWeek[0]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">P2</th>
                        <td><?php echo $forecastsNextWeek[1]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">P3</th>
                        <td><?php echo $forecastsNextWeek[2]; ?></td>
                    </tr>              
            </tbody>
        </table>
    </div>

</body>

</html>