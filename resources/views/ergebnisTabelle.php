<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/classes/entities/Kaufteil.php');

require_once($documentRoot . '/ibsys2_backend/navbar.php');
require_once($documentRoot . '/ibsys2_backend/classes/services/XML_Writer_Service.php');

$xmlWriter = new XML_Writer_Service();
?>
<h2><?php if ($_SESSION['language'] == "DE") {
      echo "Ergebnistabelle";
    } else {
      echo "Result Table";
    }
    ?></h2>
<div>
  <div>
    <table class="table table-bordered">
      <thead>
        <h3>Direktverkäufe</h3>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Teile Nr.</th>
          <th scope="row">Anzahl</th>
        </tr>
        <?php
        for ($i = 0; $i < count($_SESSION['direktVerkaeufe']); $i++) : ?>
          <tr>
            <td scope="col"><?php echo "P" . $i + 1 ?></td>
            <td scope="col"><?php echo $_SESSION['direktVerkaeufe'][$i]['amount']; ?></td>
          </tr>
        <?php endfor; ?>
      </tbody>
    </table>

    <table class="table table-bordered">
      <h3>Einkaufsaufträge</h3>
      <tr>
        <th scope="row">Teile Nr.</th>
        <th scope="row">Anzahl</th>
        <th scope="row">N / E</th>
      </tr>
      <?php
      foreach ($_SESSION['kaufteile'] as $kaufteil) : ?>
        <tr>
          <td scope="col"><?php echo $kaufteil->nummer; ?></td>
          <td scope="col"><?php echo $kaufteil->bestellMenge ?></td>
          <td scope="col"><?php echo ($kaufteil->eilBestellung) ? "E" : "N"; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <table class="table table-bordered">
      <h3>Produktionsaufträge</h3>
      <tr>
        <th scope="row">Teile Nr.</th>
        <th scope="row">Anzahl</th>
        <th scope="row">Priorität</th>
      </tr>
      <?php
      foreach ($_SESSION['alleAuftraege'] as $auftrag) : ?>
        <tr>
          <td scope="col"><?php echo $auftrag[0]; ?></td>
          <td scope="col"><?php echo $auftrag[1]; ?></td>
          <td scope="col"><?php echo $auftrag[2]; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <table class="table table-bordered">
      <tr>
        <h3>Produktionskapazitäten</h3>
      </tr>
      <tr>
        <th scope="row">Arbeitsplatz</th>
        <th scope="row">Schichten(1,2,3)</th>
        <th scope="row">Überstunden (min/Tag)</th>
      </tr>
      <?php
      $schichten = $_SESSION['schichten'];
      $ueberstunden = $_SESSION['ueberstunden'];
      for ($i = 0; $i < count($schichten); $i++) : ?>
        <tr>
          <td scope="col"><?php echo $i + 1; ?></td>
          <td scope="col"><?php echo $schichten[$i]; ?></td>
          <td scope="col"><?php echo $ueberstunden[$i]; ?></td>
        </tr>
      <?php endfor; ?>
    </table>
  </div>
  <form method="post">
    <input type="submit" name="download" class="btn btn-primary" value="Ergebnisse abschicken">
  </form>
  <form method="post" action="ende.php">
    <input type="submit" name="download" class="btn btn-primary" value="Download">
  </form>
  <form method="post" action="../../index.php">
    <input type="submit" name="download" class="btn btn-primary" value="Zurück zur Startseite">
  </form>
</div>

<?php
if (array_key_exists('download', $_POST)) {
  $prodprogODV = $_SESSION['prodprogODV'];
  $direktVerkaeufe = $_SESSION['direktVerkaeufe'];
  $bestellungen = $_SESSION['kaufteile'];
  $produktionsauftraege = $_SESSION['alleAuftraege'];
  $schichtenUeberstunden = $_SESSION['schichtenUeberstunden'];
  $xmlWriter->write_output_to_xml($prodprogODV, $direktVerkaeufe, $bestellungen, $produktionsauftraege, $schichtenUeberstunden);
}

require_once($documentRoot . '/ibsys2_backend/footer.php');
?>