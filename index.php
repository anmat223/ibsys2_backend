<?php
require './classes/services/Database_Service.php';

$database = new DatabaseService();
$database->createDatabase();
$database->createTables();
$database->insertPredifinedData();

include './navbar.php';
include './footer.php';

?> <h1><?php if ($_SESSION['language'] == "DE") {
    echo "Willkommen im IBSYS 2 Rechner!";
  } else {
    echo "Welcome to the IBSYS 2 Calculator!";
  }
  ?></h1>