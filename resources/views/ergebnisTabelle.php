<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/classes/entities/Kaufteil.php');

require_once($documentRoot . '/ibsys2_backend/navbar.php');
?>
<div>
  <div>
    <table class="table table-bordered">
      <thead>
        <h2>Direktverkäufe</h2>
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
            <td scope="col"><input type="number" class="form-control" name="<?php echo 'dV' . $i ?>" value="<?php echo $_SESSION['direktVerkaeufe'][$i]['amount']; ?>"></td>
          </tr>
        <?php endfor; ?>
      </tbody>
    </table>

    <table class="table table-bordered">
      <h2>Einkaufsaufträge</h2>
      <tr>
        <th scope="row">Teile Nr.</th>
        <th scope="row">Anzahl</th>
        <th scope="row">N / E</th>
      </tr>
      <?php
      foreach ($_SESSION['kaufteile'] as $kaufteil) : ?>
        <tr>
          <td scope="col"><?php echo $kaufteil->nummer; ?></td>
          <td scope="col"><input type="number" class="form-control" name="<?php 'bM' . $kaufteil->nummer ?>" value="<?php echo $kaufteil->bestellMenge ?>"></td>
          <td scope="col"><input type="text" class="form-control" name="<?php 'eB' . $kaufteil->nummer ?>" value="<?php echo ($kaufteil->eilBestellung) ? "E" : "N" ?>"></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <table class="table table-bordered">
      <h2>Produktionsaufträge</h2>
      <tr>
        <th scope="row">Teile Nr.</th>
        <th scope="row">Anzahl</th>
      </tr>
      <?php
      ksort($produktionsauftraege);
      foreach ($produktionsauftraege as $key => $auftrag) : ?>
        <tr>
          <td scope="col"><?php echo $key; ?></td>
          <td scope="col"><input type="number" class="form-control" name="<?php 'pA' . $key ?>" value="<?php echo $auftrag ?>"></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <table class="table table-bordered">
      <tr>
        <h2>Produktionskapazitäten</h2>
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
          <td scope="col"><input type="number" class="form-control" name="<?php 's' . $i ?>" value="<?php echo $schichten[$i]; ?>"></td>
          <td scope="col"><input type="text" class="form-control" name="<?php 'ue' . $i ?>" value="<?php echo $ueberstunden[$i]; ?>"></td>
        </tr>
      <?php endfor; ?>
    </table>
  </div>
  <button type="button" class="btn btn-primary">Download XML</button>
</div>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>