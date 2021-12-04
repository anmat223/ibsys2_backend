<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');
?>

<h2>Aufträge für die nächste Woche</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" data-editable="true">Produkt</th>
      <th scope="col"> Anzahl Aufträge vom Vertrieb</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">P1</th>
      <td>
        <?php echo $_POST["input1"]; ?>
      </td>
    </tr>
    <tr>
      <th scope="row">P2</th>
      <td>
        <?php echo $_POST["input2"]; ?>
      </td>
    </tr>
    <tr>
      <th scope="row">P3</th>
      <td>
        <?php echo $_POST["input3"]; ?>
      </td>
    </tr>
  </tbody>
</table>


<h2>Direktverkäufe für die nächste Woche</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" data-editable="true">Produkt</th>
      <th scope="col"> Anzahl Direktverkäufe</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">P1</th>
      <td>
        <?php echo $_POST["input_dv_1"]; ?>
      </td>
    </tr>
    <tr>
      <th scope="row">P2</th>
      <td>
        <?php echo $_POST["input_dv_2"]; ?>
      </td>
    </tr>
    <tr>
      <th scope="row">P3</th>
      <td>
        <?php echo $_POST["input_dv_3"]; ?>
      </td>
    </tr>
  </tbody>
</table>
<?php
$p1 = $_POST["input1"];
$p2 = $_POST["input2"];
$p3 = $_POST["input3"];

$dv_p1 = $_POST["input_dv_1"];
$dv_p2 = $_POST["input_dv_2"];
$dv_p3 = $_POST["input_dv_3"];

$produktionsprogramm = [];
if ($_POST["auslieferungsPeriode_1"] == "diese") {
  $summeP1 = $p1 + $dv_p1;
} else {
  $summeP1 = $p1;
}
if ($_POST["auslieferungsPeriode_2"] == "diese") {
  $summeP2 = $p2 + $dv_p2;
} else {
  $summeP2 = $p2;
}
if ($_POST["auslieferungsPeriode_3"] == "diese") {
  $summeP3 = $p3 + $dv_p3;
} else {
  $summeP3 = $p3;
}

array_push($produktionsprogramm, $summeP1, $summeP2, $summeP3);
$_SESSION['produktionsprogramm'] = $produktionsprogramm;

$direktVerkP1 = [
  "amount" => $_POST["input_dv_1"],
  "price" => $_POST["input_dv_1_price"],
  "penalty" => $_POST["input_dv_1_penalty"],
  "auslieferung" => $_POST["auslieferungsPeriode_1"]
];
$direktVerkP2 = [
  "amount" => $_POST["input_dv_2"],
  "price" => $_POST["input_dv_2_price"],
  "penalty" => $_POST["input_dv_2_penalty"],
  "auslieferung" => $_POST["auslieferungsPeriode_2"]
];
$direktVerkP3 = [
  "amount" => $_POST["input_dv_3"],
  "price" => $_POST["input_dv_3_price"],
  "penalty" => $_POST["input_dv_3_penalty"],
  "auslieferung" => $_POST["auslieferungsPeriode_3"]
];

$direktVerkaeufe = [];
array_push($direktVerkaeufe, $direktVerkP1, $direktVerkP2, $direktVerkP3);
$_SESSION['direktVerkaeufe'] = $direktVerkaeufe;

?>
<h2>Produktionsaufträge für die nächste Woche (Summe Aufträge und Direktverkäufe)</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" data-editable="true">Produkt</th>
      <th scope="col"> Anzahl Aufträge vom Vertrieb</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">P1</th>
      <td>
        <?php echo $produktionsprogramm[0]; ?>
      </td>
    </tr>
    <tr>
      <th scope="row">P2</th>
      <td>
        <?php echo $produktionsprogramm[1]; ?>
      </td>
    </tr>
    <tr>
      <th scope="row">P3</th>
      <td>
        <?php echo $produktionsprogramm[2]; ?>
      </td>
    </tr>
  </tbody>
</table>
<form action="produktionsteilDisposition.php" method="post">
  <input type="submit">
</form>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>