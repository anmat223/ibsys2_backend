<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/navbar.php');

$schichten = [];
$ueberstunden = [];
for ($i = 0; $i < 15; $i++) {
  array_push($schichten, intval($_POST["S" . $i + 1]));
  array_push($ueberstunden, intval($_POST["UE" . $i + 1]));
}

$_SESSION['schichtenUeberstunden'] = array($ueberstunden, $schichten);

header('Location: kaufteilDisposition.php');
