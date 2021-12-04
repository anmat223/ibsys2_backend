<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');
?>
<div>
  <?php
  // print_r( $ruestzeitNeu); Zur Ansicht des arrays
  ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" data-editable="true">Kapazitätsplan</th>
        <th scope="col">1</th>
        <th scope="col">2</th>
        <th scope="col">3</th>
        <th scope="col">4</th>
        <th scope="col">5</th>
        <th scope="col">6</th>
        <th scope="col">7</th>
        <th scope="col">8</th>
        <th scope="col">9</th>
        <th scope="col">10</th>
        <th scope="col">11</th>
        <th scope="col">12</th>
        <th scope="col">13</th>
        <th scope="col">14</th>
        <th scope="col">15</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Kapazitätsbedarf(neu)</th>
        <td> <?php echo $kapazitaetsbedarfNeu[0] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[1] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[2] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[3] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[4] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[5] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[6] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[7] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[8] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[9] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[10] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[11] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[12] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[13] ?> </td>
        <td> <?php echo $kapazitaetsbedarfNeu[14] ?> </td>
      </tr>
      <tr>
        <th scope="row">Rüstzeit(neu)</th>
        <td> <?php echo $ruestzeitNeu[0]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[1]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[2]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[3]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[4]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[5]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[6]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[7]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[8]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[9]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[10]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[11]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[12]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[13]["ruestzeit"] ?> </td>
        <td> <?php echo $ruestzeitNeu[14]["ruestzeit"] ?> </td>
      </tr>
      <tr>
        <th scope="row">Kap.bed.(Rückstand Vorperiode)</th>
        <td> <?php echo $kapazitaetsbedarfAlt[0]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[1]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[2]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[3]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[4]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[5]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[6]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[7]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[8]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[9]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[10]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[11]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[12]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[13]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfAlt[14]; ?> </td>
      </tr>
      <tr>
        <th scope="row">Rüstzeit(Rückstand Vorperiode)</th>
        <td> <?php echo $ruestzeitAlt[0]; ?> </td>
        <td> <?php echo $ruestzeitAlt[1]; ?> </td>
        <td> <?php echo $ruestzeitAlt[2]; ?> </td>
        <td> <?php echo $ruestzeitAlt[3]; ?> </td>
        <td> <?php echo $ruestzeitAlt[4]; ?> </td>
        <td> <?php echo $ruestzeitAlt[5]; ?> </td>
        <td> <?php echo $ruestzeitAlt[6]; ?> </td>
        <td> <?php echo $ruestzeitAlt[7]; ?> </td>
        <td> <?php echo $ruestzeitAlt[8]; ?> </td>
        <td> <?php echo $ruestzeitAlt[9]; ?> </td>
        <td> <?php echo $ruestzeitAlt[10]; ?> </td>
        <td> <?php echo $ruestzeitAlt[11]; ?> </td>
        <td> <?php echo $ruestzeitAlt[12]; ?> </td>
        <td> <?php echo $ruestzeitAlt[13]; ?> </td>
        <td> <?php echo $ruestzeitAlt[14]; ?> </td>
      </tr>
      <tr>
        <th scope="row">Gesamt-Kapazitätsbedarf</th>
        <td> <?php echo $kapazitaetsbedarfGesamt[0]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[1]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[2]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[3]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[4]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[5]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[6]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[7]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[8]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[9]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[10]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[11]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[12]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[13]; ?> </td>
        <td> <?php echo $kapazitaetsbedarfGesamt[14]; ?> </td>
      </tr>
      <tr>
        <th scope="row">Schichten</th>
        <td> <?php echo $schichten[0]; ?> </td>
        <td> <?php echo $schichten[1]; ?> </td>
        <td> <?php echo $schichten[2]; ?> </td>
        <td> <?php echo $schichten[3]; ?> </td>
        <td> <?php echo $schichten[4]; ?> </td>
        <td> <?php echo $schichten[5]; ?> </td>
        <td> <?php echo $schichten[6]; ?> </td>
        <td> <?php echo $schichten[7]; ?> </td>
        <td> <?php echo $schichten[8]; ?> </td>
        <td> <?php echo $schichten[9]; ?> </td>
        <td> <?php echo $schichten[10]; ?> </td>
        <td> <?php echo $schichten[11]; ?> </td>
        <td> <?php echo $schichten[12]; ?> </td>
        <td> <?php echo $schichten[13]; ?> </td>
        <td> <?php echo $schichten[14]; ?> </td>
      </tr>
      <tr>
        <th scope="row">Überstunden</th>
        <td> <?php echo $ueberstunden[0]; ?> </td>
        <td> <?php echo $ueberstunden[1]; ?> </td>
        <td> <?php echo $ueberstunden[2]; ?> </td>
        <td> <?php echo $ueberstunden[3]; ?> </td>
        <td> <?php echo $ueberstunden[4]; ?> </td>
        <td> <?php echo $ueberstunden[5]; ?> </td>
        <td> <?php echo $ueberstunden[6]; ?> </td>
        <td> <?php echo $ueberstunden[7]; ?> </td>
        <td> <?php echo $ueberstunden[8]; ?> </td>
        <td> <?php echo $ueberstunden[9]; ?> </td>
        <td> <?php echo $ueberstunden[10]; ?> </td>
        <td> <?php echo $ueberstunden[11]; ?> </td>
        <td> <?php echo $ueberstunden[12]; ?> </td>
        <td> <?php echo $ueberstunden[13]; ?> </td>
        <td> <?php echo $ueberstunden[14]; ?> </td>
      </tr>
    </tbody>
  </table>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>