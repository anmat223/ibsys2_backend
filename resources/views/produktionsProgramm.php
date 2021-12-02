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
          <a class="nav-link" href="./uploadXML.html">Upload XML</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./produktionsProgramm.php">Produktionsprogramm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./kapazitaetsplan.php">Kapazitätsplan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./kaufteilDisposition.php">KaufteilDisposition</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./ergebnisTabelle.php">ErgebnisTabelle</a>
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
    require_once('../../classes/services/XML_Reader_Service.php'); //classes\services\XML_Reader_Service.php
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

  <form action="getProduktionsprogramm.php" method="post">
    <h2>Wie viel möchten Sie produzieren?</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" data-editable="true">Produkt</th>
          <th scope="col"> Anzahl Produktionsaufträge</th>
        </tr>
      </thead>
      <tbody>

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

        <h2>Direktverkäufe</h2>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" data-editable="true">Produkt</th>
              <th scope="col"> Anzahl Direktverkäufe</th>
              <th scope="col">Preis</th>
              <th scope="col">Strafe</th>
              <th scope="col">Auslieferungsperiode</th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <th scope="row">P1</th>
              <td>
                <input type="number" class="form-control" name="input_dv_1">
              </td>
              <td>
                <input type="number" class="form-control" name="input_dv_1_price">
              </td>
              <td>
                <input type="number" class="form-control" name="input_dv_1_penalty">
              </td>
              <td>               
                  <div class="form-group">
                    <select class="form-control" id="p1" name="auslieferungsPeriode_1">
                      <option value="diese">diese </option>
                      <option value="naechste">nächste</option>
                      <option value="uebernaechste">übernächste</option>
                    </select>                                     
                  </div>
              </td>
            </tr>
            <tr>
              <th scope="row">P2</th>
              <td>
                <input type="number" class="form-control" name="input_dv_2">
              </td>
              <td>
                <input type="number" class="form-control" name="input_dv_2_price">
              </td>
              <td>
                <input type="number" class="form-control" name="input_dv_2_penalty">
              </td>
              <td>
                <div class="form-group">
                  <select class="form-control" id="p2" name="auslieferungsPeriode_2">
                    <option>diese </option>
                    <option>nächste</option>
                    <option>übernächste</option>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">P3</th>
              <td>
                <input type="number" class="form-control" name="input_dv_3">
              </td>
              <td>
                <input type="number" class="form-control" name="input_dv_3_price">
              </td>
              <td>
                <input type="number" class="form-control" name="input_dv_3_penalty">
              </td>
              <td>
                <div class="form-group">
                  <select class="form-control" id="p3" name="auslieferungsPeriode_3">
                    <option>diese </option>
                    <option>nächste</option>
                    <option>übernächste</option>
                  </select>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <input type="submit">
  </form>
</body>

</html>