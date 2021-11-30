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
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navigation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../../index.php">Home <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./kapazitaetsplan.php">Kapazitaetsplan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./produktionsProgramm.php">Produktionsprogramm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./uploadXML.html">Upload XML</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <h2>Vertriebsprogramm für die nächste Woche</h2>
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
  <h2>Wie viel möchten Sie produzieren?</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" data-editable="true">Produkt</th>
        <th scope="col"> Anzahl Produktionsaufträge</th>
      </tr>
    </thead>
    <tbody>
      <form action="getProduktionsprogramm.php" method="post">
        <tr>
          <th scope="row">P1</th>
          <td class="input-group">
            <input type="number" class="form-control" name="input1">
          </td>
        </tr>
        <tr>
          <th scope="row">P2</th>
          <td class="input-group">
              <input type="number" class="form-control" name="input2">
          </td>
        </tr>
        <tr>
          <th scope="row">P3</th>
          <td class="input-group">
            <input type="number" class="form-control" name="input3">
          </td>
        </tr>
        <input type="submit">
      </form>
    </tbody>
  </table>

</body>

</html>