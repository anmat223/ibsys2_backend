<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Produktionsteil.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

// $post splitting in Session speichern
$splits = [];
//Für jedes Teil 
$produktionsauftraege = $_SESSION['produktionsauftraege'];
foreach($produktionsauftraege as $key => $pa){
$splits[$key] = $_POST["s". $key];

$value = $_POST["sb". $key];
$database->update("Produktionsteil","sicherheitsbestand", $value, $key);
}
$_SESSION["sb"] = 1;


header('Location: produktionsteilDisposition.php');