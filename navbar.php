<?php
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

$pointer = 0;
foreach (new DirectoryIterator($documentRoot . '/uploads/') as $file) {
  if ($file->isDot()) continue;
  $pointer = 1;
}
$keyProduktionsprogramm = array_key_exists('produktionsprogramm', $_SESSION) ? 1 : 0;
$keyProduktionsauftraege = array_key_exists('checkProduktionsauftraege', $_SESSION) ? 1 : 0;
$keyProdprogODV = array_key_exists('prodprogODV', $_SESSION) ? 1 : 0;
$keySchichtenUeberstunden = array_key_exists('schichtenUeberstunden', $_SESSION) ? 1 : 0;
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navigation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link <?php if ($pointer == 1) echo "btn disabled" ?>" href="/index.php">Start<span class="sr-only"></span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if ($pointer == 1) echo "btn disabled" ?>" href="/resources/views/uploadXML.php">Upload XML</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/resources/views/produktionsProgramm.php">Produktionsprogramm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($keyProduktionsprogramm == 0) echo "btn disabled" ?>" href="/resources/views/produktionsteilDisposition.php">Produktionsteildisposition</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($keyProduktionsprogramm == 0 || $keyProduktionsauftraege == 0) echo "btn disabled" ?>" href="/resources/views/reihenfolgePlanung.php">Reihenfolgeplanung</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($keyProduktionsprogramm == 0 || $keyProduktionsauftraege == 0) echo "btn disabled" ?>" href="/resources/views/kapazitaetsplan.php">Kapazitätsplan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($keyProduktionsprogramm == 0 || $keyProduktionsauftraege == 0) echo "btn disabled" ?>" href="/resources/views/kaufteilDisposition.php">Kaufteil Disposition</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($keyProduktionsprogramm == 0 || $keyProduktionsauftraege == 0 || $keyProdprogODV == 0 || $keySchichtenUeberstunden == 0) echo "btn disabled" ?>" href="/resources/views/ergebnisTabelle.php">Ergebnistabelle</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php
  if (!array_key_exists('language', $_SESSION)) {
    $_SESSION["language"] = "DE";
  }
  ?>
  <input type="button" class="btn btn-dark" value="<?php echo $_SESSION['language'] ?>" id="languageswitcher" />
  <button class="btn btn-dark"><a style="color: white" target="_blank" href="https://docs.google.com/document/d/1D71PmB9vqSbD4kPu2gR-wBoK43DURUrmdph5P6lcZIA/edit#heading=h.23kz4gke8km5%22%3EHandbuch">Handbuch</a></button>
  <?php

  $documentRoot = $_SERVER['DOCUMENT_ROOT'];
  require_once($documentRoot . '/classes/entities/Produktionsteil.php');
  require_once($documentRoot . '/classes/services/XML_Reader_Service.php');
  require_once($documentRoot . '/classes/services/Disposition_Eigenproduktion-Service.php');
  require_once($documentRoot . '/classes/services/Kapazitätsplan_Kapazitätsbedarf-Service.php');
  require_once($documentRoot . '/classes/services/Disposition_Kaufteile-Service.php');

  $filename = null;
  foreach (new DirectoryIterator($documentRoot . '/uploads/') as $file) {
    if ($file->isDot()) continue;
    $filename = $file->getFilename();
  }

  $readerService = new XML_Reader_Service($filename);
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
    for ($j = 0; $j < count($produktionsteile); $j++) {
      if ($produktionsteileDB[$i]['teil'] == $produktionsteile[$j]->nummer) {
        $teil = new Produktionsteil(
          $produktionsteileDB[$i]['teil'],
          $produktionsteile[$j]->anzahl,
          $produktionsteileDB[$i]['preis'],
          $produktionsteileDB[$i]['dreifachTeil'],
          $produktionsteileDB[$i]['sicherheitsbestand']
        );
        array_push($p, $teil);
      }
    }
  }

  $kaufteileDB = $database->read("Kaufteil", "*", join: "JOIN Teil ON Kaufteil.teil = Teil.nummer");
  ?>
  <script>
    $('#languageswitcher').click(function() {
      // fire off the request to /redirect.php
      request = $.ajax({
        url: "/resources/views/changeLanguage.php",
        type: "post",
        data: 'language'
      });

      // callback handler that will be called on success
      request.done(function(response, textStatus, jqXHR) {
        // log a message to the console
        location.reload();
        console.log("Hooray, it worked!");
      });

      // callback handler that will be called on failure
      request.fail(function(jqXHR, textStatus, errorThrown) {
        // log the error to the console
        console.error(
          "The following error occured: " +
          textStatus, errorThrown
        );
      });
    });
  </script>