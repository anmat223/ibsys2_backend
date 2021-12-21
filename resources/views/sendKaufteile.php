<?php
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/classes/services/Database_Service.php');

$database = new DatabaseService();

require_once($documentRoot . '/classes/services/XML_Reader_Service.php');

$filename = null;
foreach (new DirectoryIterator($documentRoot . '/uploads/') as $file) {
  if ($file->isDot()) continue;
  $filename = $file->getFilename();
}

$readerService = new XML_Reader_Service($filename);
$teile = $readerService->get_warehousestock();
$produktionsteile = $teile[0];
$kaufteile = $teile[1];

for ($i = 0; $i < count($kaufteile); $i++) {
  $kaufteile[$i]->bestellMenge = intval($_POST[$kaufteile[$i]->nummer]);
  $kaufteile[$i]->eilBestellung = ($_POST[$kaufteile[$i]->nummer . "_art"] == "E") ? true : false;
}
$_SESSION['kaufteile'] = $kaufteile;
$bestellungen = $_SESSION['bestellungen'];

for ($i = 0; $i < count($kaufteile); $i++) {
  $bestellungen[$i][0] = $kaufteile[$i]->bestellMenge;
  $bestellungen[$i][1] = $_POST[$kaufteile[$i]->nummer . "_art"];
}

$_SESSION['bestellungen'] = $bestellungen;

header('Location: ergebnisTabelle.php');
die();
