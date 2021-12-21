<?php
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/classes/services/Database_Service.php');
require_once($documentRoot . '/classes/entities/Produktionsteil.php');

$database = new DatabaseService();

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
$_SESSION['submit'] = true;
$_SESSION['splits'] = $splits;


header('Location: produktionsteilDisposition.php');