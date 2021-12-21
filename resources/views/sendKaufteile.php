<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

for ($i = 0; $i < count($kaufteile); $i++) {
  $kaufteile[$i]->bestellMenge = intval($_POST[$kaufteile[$i]->nummer]);
  $kaufteile[$i]->eilBestellung = ($_POST[$kaufteile[$i]->nummer . "_art"] == "E") ? true : false;
}
$_SESSION['kaufteile'] = $kaufteile;
header('Location: ergebnisTabelle.php');
die();
