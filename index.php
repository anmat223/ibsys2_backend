<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Index</title>
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
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./resources/views/kapazitaetsplan.php">Kapazitätsplan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./resources/views/produktionsProgramm.php">Produktionsprogramm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./resources/views/uploadXML.html">Upload XML</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <?php
  echo "Unser Frontend<br>";
  require './classes/services/Database_Service.php';
  $database = new DatabaseService();
  $database->createDatabase();
  $database->createTables();
  $database->insertPredifinedData();
  foreach ($database->read("teil", "nummer", "preis >= 40") as $result) {
    echo $result['nummer'];
    echo "<br>";
  }
  // XML file hochladen
  // nach Einlesen Prognose anzeigen lassen
  // Excel Seiten als Darstellung
  // direktverkäufe???? Eingabe Produktionsprogramm?????

  // xml hochladen (reiter nav bar direkt hinter startseite)
  // Auftragsmenge, Direktverkäufe festlegen (nächster Reiter) Direktverkäufe eingabe ergänzen, submit ganz unten, Eingabe in Array speichern
  // Aufrufreihenfolge

  // Disposition Eigenfertigung P1
  // Disposition Eigenfertigung P2
  // Disposition Eigenfertigung P3  
    // xmlReaderService aufrufen und variablen mit ergebnissen deklarieren
    // getWarehousestock()
    // getWaitinglistworkstations()
    // getordersinwork()
    // getwatingliststock()
    // --> Tabelle mit den Berechnungen also menge und nummer (evtl. änderbar)

  // Kapaplanung (Tabelle anzeigen)
    // getWaitinglistworkstations()
    // getordersinwork()
    // getwatingliststock()

  // Kaufteildisposition
    // kaufteile aus getwarehousestock()
    // produktionsprogramm (input aus form) + direktverkäufe aus input (summe)
  // --> Tabelle mit den Berechnungen menge und nummer, diskontmenge
  // Eingabetabelle als Zusammenfassung
  ?>
</body>

</html>