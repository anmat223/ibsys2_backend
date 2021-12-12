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
      echo "Ergebnistabellen";
    } else {
      echo "Result Tables";
    }
    ?></h2>
<br>
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
        if(!array_key_exists('direktVerkaeufe', $_SESSION)) {$_SESSION['direktVerkaeufe'] = [];}
        for ($i = 0; $i < count($_SESSION['direktVerkaeufe']); $i++) : ?>
          <tr>
            <th scope="row"><?php echo "P" . $i + 1 ?></td>
            <td scope="col"><?php echo $_SESSION['direktVerkaeufe'][$i]['amount']; ?></td>
          </tr>
        <?php endfor; ?>
      </tbody>
    </table>
    <br>

    <table class="table table-bordered">
      <h3>Einkaufsaufträge</h3>
      <tr>
        <th scope="row">Teile Nr.</th>
        <th scope="row">Anzahl</th>
        <th scope="row">N / E</th>
      </tr>
      <?php
      if(!array_key_exists('kaufteile', $_SESSION)) {$_SESSION['kaufteile'] = [];}
      foreach ($_SESSION['kaufteile'] as $kaufteil) : ?>
        <tr>
          <th scope="row"><?php echo $kaufteil->nummer; ?></td>
          <td scope="col"><?php echo $kaufteil->bestellMenge ?></td>
          <td scope="col"><?php echo ($kaufteil->eilBestellung) ? "E" : "N"; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <br>

    <table class="table table-bordered">
      <h3>Produktionsaufträge</h3>
      <tr>
        <th scope="row">Teile Nr.</th>
        <th scope="row">Anzahl</th>
        <th scope="row">Priorität</th>
      </tr>
      <?php
      if(!array_key_exists('alleAuftraege', $_SESSION)) {$_SESSION['alleAuftraege'] = [];}
      foreach ($_SESSION['alleAuftraege'] as $auftrag) : ?>
        <tr>
          <th scope="row"><?php echo $auftrag[0]; ?></td>
          <td scope="col"><?php echo $auftrag[1]; ?></td>
          <td scope="col"><?php echo $auftrag[2]; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <br>

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
      if(!array_key_exists('schichtenUeberstunden', $_SESSION)) {$_SESSION['schichtenUeberstunden'] = [array(),array()];}
      $schichten = $_SESSION['schichtenUeberstunden'][1];
      $ueberstunden = $_SESSION['schichtenUeberstunden'][0];
      for ($i = 0; $i < count($schichten); $i++) : ?>
        <tr>
          <th scope="row"><?php echo $i + 1; ?></td>
          <td scope="col"><?php echo $schichten[$i]; ?></td>
          <td scope="col"><?php echo $ueberstunden[$i]; ?></td>
        </tr>
      <?php endfor; ?>
    </table>
    <br>

  </div>

  <div class="d-grid gap-3 d-md-block">
    <form method="post" style="display: inline-block;" action="ergebnisTabelle.php#form-anchor" id="form-anchor">
      <input type="submit" name="download" class="btn btn-dark" value="Ergebnisse abschicken">
    </form>
    <form method="post" style="display: inline-block;" action="ende.php">
      <input type="submit" name="download" class="btn btn-dark" value="Download">
    </form>
    <form method="post" style="display: inline-block;" action="../../index.php">
      <input type="submit" name="download" class="btn btn-dark" value="Zurück zur Startseite">
    </form>
  </div>
</div>

<?php
if (array_key_exists('download', $_POST)) {
  $prodprogODV = $_SESSION['prodprogODV'];
  $direktVerkaeufe = $_SESSION['direktVerkaeufe'];
  $bestellungen = $_SESSION['kaufteile'];
  foreach ($bestellungen as $key => $b) {
    if ($b->bestellMenge == 0) {
      unset($bestellungen[$key]);
    }
  }
  $produktionsauftraege = $_SESSION['alleAuftraege'];
  $schichtenUeberstunden = $_SESSION['schichtenUeberstunden'];
  $xmlWriter->write_output_to_xml($prodprogODV, $direktVerkaeufe, $bestellungen, $produktionsauftraege, $schichtenUeberstunden);
}

require_once($documentRoot . '/ibsys2_backend/footer.php');
?>