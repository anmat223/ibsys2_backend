<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

$produktionsauftraege = $_SESSION['produktionsauftraege'];
ksort($produktionsauftraege);
$alleAuftraege = [];

foreach ($produktionsauftraege as $nr => $teil) {
  if ($teil[1] != 1) {
    foreach ($teil[2] as $los) {
      array_push($alleAuftraege, array($nr, $los, 5));
    }
  } else {
    array_push($alleAuftraege, array($nr, $teil[0], 5));
  }
}

$_SESSION['alleAuftraege'] = $alleAuftraege;
?>
<h2><?php if ($_SESSION['language'] == "DE") {
      echo "Reihenfolgeplanung";
    } else {
      echo "Sequence Planing";
    }
    ?></h2>
<form action="sendReihenfolge.php" method="post">
  <table class="table table-bordered">
    <thead>
      <h3>Reihenfolgeplanung</h3>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Teile Nr.</th>
        <th scope="row">Losgröße</th>
        <th scope="row">Priorität</th>
      </tr>
      <?php
      for ($i = 0; $i < count($alleAuftraege); $i++) : ?>
        <tr>
          <td scope="col"><?php echo $alleAuftraege[$i][0]; ?></td>
          <td scope="col"><?php echo $alleAuftraege[$i][1]; ?></td>
          <td scope="col"><input type="number" name="<?php echo "prio" . $i ?>" value="<?php echo $alleAuftraege[$i][2]; ?>"></td>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
  <input type="submit">
</form>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>