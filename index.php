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
    für die Vorlesung Integrierte betriebliche Systeme 2 im Wintersemester 2021/2022 an der Hochschule Karlsruhe entwickelt.
  </h3>
  <br>
  <input type="button" class="btn btn-dark" value="Start" onclick="parent.location='/ibsys2_backend/resources/views/uploadXML.php'" />
  <footer class="bg-dark text-center text-white fixed-bottom" style="margin-top: 25px;">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2021 Alicia Grüneberg, Anne Matrusch, Niklas Uhr, Vincent Mielke
    </div>
  </footer>
</body>

</html>