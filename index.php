<?php
require './classes/services/Database_Service.php';

$database = new DatabaseService();
$database->createDatabase();
$database->createTables();
$database->insertPredifinedData();

include './navbar.php';
include './footer.php';

$_SESSION['language']='DE';

?> <h1>Wilkommen im IBSYS 2 Rechner!</h1>