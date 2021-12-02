<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Produktionsauftraege fuer die naechste Woche:</title>
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

<h2>Aufträge für die nächste Woche</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" data-editable="true">Produkt</th>
        <th scope="col"> Anzahl Aufträge vom Vertrieb</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">P1</th>
        <td>
          <?php echo $_POST["input1"]; ?>
        </td>
      </tr>
      <tr>
        <th scope="row">P2</th>
        <td>
          <?php echo $_POST["input2"]; ?>
          </td>
      </tr>
      <tr>
        <th scope="row">P3</th>
        <td>
          <?php echo $_POST["input3"]; ?>
        </td>
      </tr>
    </tbody>
  </table>


  <h2>Direktverkäufe für die nächste Woche</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" data-editable="true">Produkt</th>
        <th scope="col"> Anzahl Direktverkäufe</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">P1</th>
        <td>
          <?php echo $_POST["input_dv_1"]; ?>
        </td>
      </tr>
      <tr>
        <th scope="row">P2</th>
        <td>
          <?php echo $_POST["input_dv_2"]; ?>
          </td>
      </tr>
      <tr>
        <th scope="row">P3</th>
        <td>
          <?php echo $_POST["input_dv_3"]; ?>
        </td>
      </tr>
    </tbody>
  </table>
<?php
  $p1 = $_POST["input1"];
  $p2 = $_POST["input2"];
  $p3 = $_POST["input3"];

  $dv_p1 = $_POST["input_dv_1"];
  $dv_p2 = $_POST["input_dv_2"];
  $dv_p3 = $_POST["input_dv_3"];

  $produktionsprogramm = [];
  if($_POST["auslieferungsPeriode_1"] == "diese"){
    $summeP1 = $p1 + $dv_p1;
  } else {
    $summeP1 = $p1;
  }
  if($_POST["auslieferungsPeriode_2"] == "diese") {
    $summeP2 = $p2 + $dv_p2;
  } else {
    $summeP2 = $p2;
  }
  if($_POST["auslieferungsPeriode_3"] == "diese") {
    $summeP3 = $p3 + $dv_p3;
  } else {
    $summeP3 = $p3;
  }
  
  array_push($produktionsprogramm, $summeP1, $summeP2, $summeP3); 
  $direktVerkP1 = [
    "amount" => $_POST["input_dv_1"], 
    "price" => $_POST["input_dv_1_price"],
    "penalty" => $_POST["input_dv_1_penalty"],
    "auslieferung" => $_POST["auslieferungsPeriode_1"]
  ];
  $direktVerkP2 = [
    "amount" => $_POST["input_dv_2"], 
    "price" => $_POST["input_dv_2_price"],
    "penalty" => $_POST["input_dv_2_penalty"],
    "auslieferung" => $_POST["auslieferungsPeriode_2"]
  ];
  $direktVerkP3 = [
    "amount" => $_POST["input_dv_3"], 
    "price" => $_POST["input_dv_3_price"],
    "penalty" => $_POST["input_dv_3_penalty"],
    "auslieferung" => $_POST["auslieferungsPeriode_3"]
  ];
 
?>
<h2>Produktionsaufträge für die nächste Woche (Summe Aufträge und Direktverkäufe)</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" data-editable="true">Produkt</th>
        <th scope="col"> Anzahl Aufträge vom Vertrieb</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">P1</th>
        <td>
          <?php echo $produktionsprogramm[0]; ?>
        </td>
      </tr>
      <tr>
        <th scope="row">P2</th>
        <td>
          <?php echo $produktionsprogramm[1]; ?>
          </td>
      </tr>
      <tr>
        <th scope="row">P3</th>
        <td>
          <?php echo $produktionsprogramm[2]; ?>
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>
<?php

