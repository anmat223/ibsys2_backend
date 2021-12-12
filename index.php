<?php

$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/navbar_without_logik.php');

require './classes/services/Database_Service.php';

$database = new DatabaseService();
$database->createDatabase();
$database->createTables();
$database->insertPredifinedData();
?>

<body>
  <h1>
  <?php if ($_SESSION['language'] == "DE") {
          echo "Willkommen im IBSYS 2 Rechner!";
        } else {
          echo "Welcome to the IBSYS 2 Calculator!";
        }
        ?>
  </h1>
  <br>
  <h3>Dieses Tool wurde von Alicia Grüneberg, Anne Matrusch, Niklas Uhr und Vincent Mielke
    für die Vorlesung Integrierte betriebliche Systeme 2 im Wintersemester 2020/2021 entwickelt.
  </h3>
  <br>
  <input type="button" class="btn btn-dark" value="Start" onclick="parent.location='/ibsys2_backend/resources/views/uploadXML.php'" />
</body>

</html>