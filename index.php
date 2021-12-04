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
          <a class="nav-link" href="./resources/views/uploadXML.html">Upload XML</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./resources/views/produktionsProgramm.php">Produktionsprogramm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./resources/views/kapazitaetsplan.php">Kapazitätsplan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./resources/views/kaufteilDisposition.php">KaufteilDisposition</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./resources/views/ergebnisTabelle.php">ErgebnisTabelle</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <?php
  require './classes/services/Database_Service.php';
  require './classes/services/XML_Reader_Service.php';
  require './classes/services/Disposition_Eigenproduktion-Service.php';
  require './classes/services/Kapazitätsplan_Kapazitätsbedarf-Service.php';
  require './classes/services/Disposition_Kaufteile-Service.php';

  $database = new DatabaseService();
  $database->createDatabase();
  $database->createTables();
  $database->insertPredifinedData();

  $readerService = new XML_Reader_Service();
  $teile = $readerService->get_warehousestock();
  $produktionsteile = $teile[0];
  $kaufteile = $teile[1];
  $wartelisteArbeitsplatz = $readerService->get_waitinglistworkstations();
  $inBearbeitung = $readerService->get_ordersinwork();
  $inWarteschlange = $readerService->get_waitingliststock();

  $warteliste = array_merge($wartelisteArbeitsplatz, $inBearbeitung, $inWarteschlange);
  echo print_r($teile);

  $produktionsteileDB = $database->read("Produktionsteile", "*", order: "nummer ASC");

  // Disposition Eigenfertigung P1
  // Disposition Eigenfertigung P2
  // Disposition Eigenfertigung P3  
  // xmlReaderService aufrufen und variablen mit ergebnissen deklarieren
  // getWarehousestock()
  // getWaitinglistworkstations()
  // getordersinwork()
  // getwatingliststock()
  // --> Tabelle mit den Berechnungen also menge und nummer (evtl. änderbar)

  $eigenproduktionsService = new DispositionEigenproduktionService();
  $produktionsauftraege = $eigenproduktionsService->alleProduktionsauftraegeBerechnen($produktionsteileDB, $warteliste);

  // Kapaplanung (Tabelle anzeigen)
  // getWaitinglistworkstations()
  // getordersinwork()
  // getwatingliststock()

  $kapazitaetsbedarfService = new KapazitätsbedarfNeuService();
  // Funktionsaufruf zur Berechnung. Welche Funktion?

  // Kaufteildisposition
  // kaufteile aus getwarehousestock()
  // produktionsprogramm (input aus form) + direktverkäufe aus input (summe)
  // --> Tabelle mit den Berechnungen menge und nummer, diskontmenge
  // Eingabetabelle als Zusammenfassung

  $kaufteileService = new DispositionKaufteileService();
  $produktionsprogramm = null; // Input aus Vertriebswunsch und Direktverkäufe
  $bestellungen = $kaufteileService->alleBestellungenBerechnen($kaufteile, $produktionsprogramm);
  ?>
</body>

</html>