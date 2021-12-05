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

$p1_periode2 = $_POST["input1_p2"];
$p1_periode3 = $_POST["input1_p3"];
$p1_periode4 = $_POST["input1_p4"];

$p2_periode2 = $_POST["input2_p2"];
$p2_periode3 = $_POST["input2_p3"];
$p2_periode4 = $_POST["input2_p4"];

$p3_periode2 = $_POST["input3_p2"];
$p3_periode3 = $_POST["input3_p3"];
$p3_periode4 = $_POST["input3_p4"];


$dv_p1 = $_POST["input_dv_1"];
$dv_p2 = $_POST["input_dv_2"];
$dv_p3 = $_POST["input_dv_3"];

$produktionsprogramm = [];
if ($_POST["auslieferungsPeriode_1"] == "diese" && !empty($dv_p1)) {
  $summeP1 = $p1 + $dv_p1;
} else {
  $summeP1 = $p1;
}
if ($_POST["auslieferungsPeriode_2"] == "diese" && !empty($dv_p2)) {
  $summeP2 = $p2 + $dv_p2;
} else {
  $summeP2 = $p2;
}
if ($_POST["auslieferungsPeriode_3"] == "diese" && !empty($dv_p3)) {
  $summeP3 = $p3 + $dv_p3;
} else {
  $summeP3 = $p3;
}

array_push($produktionsprogramm, $summeP1, $summeP2, $summeP3);
$_SESSION['produktionsprogramm'] = $produktionsprogramm;

$produktionsprogrammMitPrognosen = [
  array($summeP1,$summeP2,$summeP3), 
  array($p1_periode2, $p2_periode2, $p3_periode2), 
  array($p1_periode3, $p2_periode3, $p3_periode3),
  array($p1_periode4, $p2_periode4, $p3_periode4)
];
$_SESSION['produktionsprogrammMitPrognosen'] = $produktionsprogrammMitPrognosen;

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