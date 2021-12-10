<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

$kaufteileService = new DispositionKaufteileService();
for ($i = 0; $i < count($kaufteileDB); $i++) {
  for ($j = 0; $j < count($kaufteile); $j++) {
    if ($kaufteile[$j]->nummer == $kaufteileDB[$i]['teil']) {
      $kaufteile[$j]->lieferzeit = $kaufteileDB[$i]['lieferzeit'];
      $kaufteile[$j]->abweichung = $kaufteileDB[$i]['abweichung'];
      $kaufteile[$j]->diskontmenge = $kaufteileDB[$i]['diskontmenge'];
      $kaufteile[$j]->p1 = $kaufteileDB[$i]['p1'];
      $kaufteile[$j]->p2 = $kaufteileDB[$i]['p2'];
      $kaufteile[$j]->p3 = $kaufteileDB[$i]['p3'];
    }
  }
}

$eingehendeBestellungen = $readerService->get_futureinwardstockmovement();
$aktuellePeriode = $readerService->get_currentPeriod();
$bestelleingaenge = $kaufteileService->berechnungBestelleingaenge($eingehendeBestellungen, $kaufteile, $aktuellePeriode);

$bestellungen = $kaufteileService->berechnungBestellung($kaufteile, $bestelleingaenge);
?>
<h2><?php if ($_SESSION['language'] == "DE") {
      echo "Kaufteildisposition";
    } else {
      echo "Purchase part disposition";
    }
    ?></h2>
<div>
  <form action="<?php echo 'sendKaufteile.php' ?>" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" data-editable="true" rowspan="2">Nr. Kaufteil</th>
          <th scope="col" rowspan="2">Lieferzeit</th>
          <th scope="col" colspan="3">Verwendung</th>
          <th scope="col" rowspan="2">Diskontmenge</th>
          <th scope="col" rowspan="2">Anfangsbestand</th>
          <th scope="col" colspan="4">Bruttobedarf gemäß Produktionsprogramm</th>
          <th scope="col" rowspan="2">Menge</th>
          <th scope="col" rowspan="2">Bestellart</th>
        </tr>
        <tr>
          <th scope="col">1</th>
          <th scope="col">2</th>
          <th scope="col">3</th>
          <th scope="col">P1</th>
          <th scope="col">P2</th>
          <th scope="col">P3</th>
          <th scope="col">P4</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($kaufteile as $index => $teil) : ?>
          <tr class="item_row">
            <th scope="row"><?php echo $teil->nummer; ?></th>
            <td><?php echo $teil->lieferzeit . " - " . $teil->lieferzeit + $teil->abweichung; ?></td>
            <td><?php echo $teil->p1; ?></td>
            <td><?php echo $teil->p2; ?></td>
            <td><?php echo $teil->p3; ?></td>
            <td><?php echo $teil->diskontmenge; ?></td>
            <td><?php echo $teil->anzahl; ?></td>
            <td><?php
                $produktionsprogrammP1 = $_SESSION['produktionsprogrammMitPrognosen'][0];
                echo $teil->p1 * $produktionsprogrammP1[0] + $teil->p2 * $produktionsprogrammP1[1] + $teil->p3 * $produktionsprogrammP1[2]; ?>
            </td>
            <td><?php
                $produktionsprogrammP2 = $_SESSION['produktionsprogrammMitPrognosen'][1];
                echo $teil->p1 * $produktionsprogrammP2[0] + $teil->p2 * $produktionsprogrammP2[1] + $teil->p3 * $produktionsprogrammP2[2]; ?>
            </td>
            <td><?php
                $produktionsprogrammP3 = $_SESSION['produktionsprogrammMitPrognosen'][2];
                echo $teil->p1 * $produktionsprogrammP3[0] + $teil->p2 * $produktionsprogrammP3[1] + $teil->p3 * $produktionsprogrammP3[2]; ?>
            </td>
            <td><?php
                $produktionsprogrammP4 = $_SESSION['produktionsprogrammMitPrognosen'][3];
                echo $teil->p1 * $produktionsprogrammP4[0] + $teil->p2 * $produktionsprogrammP4[1] + $teil->p3 * $produktionsprogrammP4[2]; ?>
            </td>
            <td>
              <input type="number" name="<?php echo $teil->nummer ?>" value="<?php echo $bestellungen[$index][0]; ?>" onchange="validate(this.value, this.name)" />
            </td>
            <td>
              <select name="<?php echo $teil->nummer ?>_art">
                <option value="N" <?php if ($bestellungen[$index][1] == "N") echo "selected" ?>>Normal</option>
                <option value="E" <?php if ($bestellungen[$index][1] == "E") echo "selected" ?>>Eil</option>
              </select>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <input type="submit" />
  </form>
</div>
<script>
  function validate(value, name) {
    if (document.getElementsByName(name)[0].value.length !== 0) {
      if (value <= 0) {
        alert('Der Wert darf nicht negativ sein!')
        document.getElementsByName(name)[0].value = 0
      }
      let strValue = String(value)
      let split = strValue.split('.')
      if (split.length > 1) {
        alert('Der Wert darf keine Nachkommastelle haben!')
        document.getElementsByName(name)[0].value = 0
      } else {
        return
      }
    } else {
      document.getElementsByName(name)[0].value = 0
    }
  }
</script>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>