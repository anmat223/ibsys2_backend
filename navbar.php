<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
          <a class="nav-link" href="http://localhost/ibsys2_backend/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/ibsys2_backend/resources/views/uploadXML.php">Upload XML</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/ibsys2_backend/resources/views/produktionsProgramm.php">Produktionsprogramm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/ibsys2_backend/resources/views/kapazitaetsplan.php">Kapazitätsplan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/ibsys2_backend/resources/views/kaufteilDisposition.php">KaufteilDisposition</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/ibsys2_backend/resources/views/ergebnisTabelle.php">ErgebnisTabelle</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <?php session_start(); ?> 
  <input type="button" value="<?php echo $_SESSION['language'] ?>" id="languageswitcher" />
  <pre>
  <?php

  $documentRoot = $_SERVER['DOCUMENT_ROOT'];
  require_once($documentRoot . '/ibsys2_backend/classes/entities/Produktionsteil.php');
  require_once($documentRoot . '/ibsys2_backend/classes/services/XML_Reader_Service.php');
  require_once($documentRoot . '/ibsys2_backend/classes/services/Disposition_Eigenproduktion-Service.php');
  require_once($documentRoot . '/ibsys2_backend/classes/services/Kapazitätsplan_Kapazitätsbedarf-Service.php');
  require_once($documentRoot . '/ibsys2_backend/classes/services/Disposition_Kaufteile-Service.php');

  $readerService = new XML_Reader_Service();
  $teile = $readerService->get_warehousestock();
  $produktionsteile = $teile[0];
  $kaufteile = $teile[1];
  $wartelisteArbeitsplatz = $readerService->get_waitinglistworkstations();
  $inBearbeitung = $readerService->get_ordersinwork();
  $inWarteschlange = $readerService->get_waitingliststock();

  $warteliste = array_merge($wartelisteArbeitsplatz, $inBearbeitung, $inWarteschlange);

  $produktionsteileDB = $database->read("Produktionsteil", "*", join: "JOIN Teil ON Produktionsteil.teil = Teil.nummer");
  $p = [];

  for ($i = 0; $i < count($produktionsteileDB); $i++) {
    $teil = new Produktionsteil(
      $produktionsteileDB[$i]['teil'],
      $produktionsteileDB[$i]['anzahl'],
      $produktionsteileDB[$i]['preis'],
      $produktionsteileDB[$i]['dreifachTeil'],
      $produktionsteileDB[$i]['sicherheitsbestand']
    );
    array_push($p, $teil);
  }

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
  $produktionsauftraege = $eigenproduktionsService->alleProduktionsauftraegeBerechnen($p, $warteliste);


  // Kapaplanung (Tabelle anzeigen)
  // getWaitinglistworkstations()
  // getordersinwork()
  // getwatingliststock()

  $kapazitaetsbedarfService = new KapazitätsbedarfNeuService();
  $kapazitaetsbedarfNeu = $kapazitaetsbedarfService->berechnungKapazitätsbedarfNeu($produktionsauftraege);
  $ruekstand = array_merge($wartelisteArbeitsplatz, $inWarteschlange);
  $kapazitaetsbedarfAlt = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  for ($i = 0; $i < count($ruekstand); $i++) {
    $kapazitaetsbedarfAlt[$ruekstand[$i]->arbeitsplatz->nummer - 1] += $ruekstand[$i]->bearbeitungszeit;
  }
  $ruestzeitAlt = $kapazitaetsbedarfService->berechnenRuestzeitAlt($ruekstand);
  $ruestzeitNeu = $database->read("Arbeitsplatz", "ruestzeit", $order = "nummer");
  $kapazitaetsbedarfGesamt = $kapazitaetsbedarfService->berechnungKapazitätsbedarfGesamt($kapazitaetsbedarfNeu, $ruestzeitNeu, $kapazitaetsbedarfAlt, $ruestzeitAlt);
  $schichtenUeberstunden = $kapazitaetsbedarfService->berechnungSchichtenÜberstunden($kapazitaetsbedarfGesamt);
  $ueberstunden = $schichtenUeberstunden[0];
  $schichten = $schichtenUeberstunden[1];
  // Funktionsaufruf zur Berechnung. Welche Funktion?

  // Kaufteildisposition
  // kaufteile aus getwarehousestock()
  // produktionsprogramm (input aus form) + direktverkäufe aus input (summe)
  // --> Tabelle mit den Berechnungen menge und nummer, diskontmenge
  // Eingabetabelle als Zusammenfassung

  $kaufteileService = new DispositionKaufteileService();
  $produktionsprogramm = array('p1' => 100, 'p2' => 150, 'p3' => 50); // Input aus Vertriebswunsch und Direktverkäufe
  $kaufteileDB = $database->read("Kaufteil", "*", join: "JOIN Teil ON Kaufteil.teil = Teil.nummer");


  for ($i = 0; $i < count($kaufteileDB); $i++) {
    for ($j = 0; $j < count($kaufteile); $j++) {
      if ($kaufteile[$j]->nummer == $kaufteileDB[$i]['teil']) {
        $kaufteile[$j]->lieferzeit = $kaufteileDB[$i]['lieferzeit'];
        $kaufteile[$j]->abweichung = $kaufteileDB[$i]['abweichung'];
        $kaufteile[$j]->diskontmenge = $kaufteileDB[$i]['diskontmenge'];
        $kaufteile[$j]->p1 = $kaufteileDB[$i]['p1'];
        $kaufteile[$j]->p2 = $kaufteileDB[$i]['p2'];
        $kaufteile[$j]->p3 = $kaufteileDB[$i]['p3'];
      }
    }
  }

  // $bestellungen = $kaufteileService->alleBestellungenBerechnen($kaufteile, $produktionsprogramm);
  ?>
  <script>
    $('#languageswitcher').click(function(){
// fire off the request to /redirect.php
request = $.ajax({
    url: "/ibsys2_backend/resources/views/changeLanguage.php",
    type: "post",
    data: 'language'
});

// callback handler that will be called on success
request.done(function (response, textStatus, jqXHR){
    // log a message to the console
    location.reload();
    console.log("Hooray, it worked!");
});

// callback handler that will be called on failure
request.fail(function (jqXHR, textStatus, errorThrown){
    // log the error to the console
    console.error(
        "The following error occured: "+
        textStatus, errorThrown
    );
    });
});
  </script>