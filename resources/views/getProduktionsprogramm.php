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
          <a class="nav-link" href="./kapazitaetsplan.php">Kapazitätsplan</a>
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

<h2>Aufträge für die nächste Woche</h2>
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
</body>
</html>
<?php

