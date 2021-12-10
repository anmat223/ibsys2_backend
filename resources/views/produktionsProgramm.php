<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');
?>
<h2><?php
    if ($_SESSION['language'] == "DE") {
      echo "Vertriebsprogramm für die nächste Woche";
    } else {
      echo "Distribution program for the next week";
    }
    ?></h2>
<div>
  <?php
  $forecastsNextWeek = $readerService->get_forecast();
  ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" data-editable="true">Produkt</th>
        <th scope="col"> Anzahl Aufträge</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">P1</th>
        <td><?php echo $forecastsNextWeek[0]; ?></td>
      </tr>
      <tr>
        <th scope="row">P2</th>
        <td><?php echo $forecastsNextWeek[1]; ?></td>
      </tr>
      <tr>
        <th scope="row">P3</th>
        <td><?php echo $forecastsNextWeek[2]; ?></td>
      </tr>
    </tbody>
  </table>
</div>

<form action="getProduktionsprogramm.php" method="post">
  <h2>Wie viel möchten Sie produzieren?</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" data-editable="true">Produkt</th>
        <th scope="col">Anzahl Produktionsaufträge diese Periode</th>
        <th scope="col">Schätzung für die nächste Periode</th>
        <th scope="col">Schätzung für übernächste Periode</th>
        <th scope="col">Schätzung für überübernächste Periode</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <th scope="row">P1</th>
        <td>
          <input type="number" class="form-control" name="input1" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input1_p2" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input1_p3" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input1_p4" value="0">
        </td>
      </tr>
      <tr>
        <th scope="row">P2</th>
        <td>
          <input type="number" class="form-control" name="input2" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input2_p2" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input2_p3" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input2_p4" value="0">
        </td>
      </tr>
      <tr>
        <th scope="row">P3</th>
        <td>
          <input type="number" class="form-control" name="input3" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input3_p2" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input3_p3" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input3_p4" value="0">
        </td>
      </tr>
    </tbody>
  </table>

  <h2>Direktverkäufe</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" data-editable="true">Produkt</th>
        <th scope="col">Anzahl Direktverkäufe</th>
        <th scope="col">Preis</th>
        <th scope="col">Strafe</th>
        <th scope="col">Auslieferungsperiode</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <th scope="row">P1</th>
        <td>
          <input type="number" class="form-control" name="input_dv_1" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input_dv_1_price" value="0.0">
        </td>
        <td>
          <input type="number" class="form-control" name="input_dv_1_penalty" value="0.0">
        </td>
        <td>
          <div class="form-group">
            <select class="form-control" id="p1" name="auslieferungsPeriode_1" value="0">
              <option value="diese">diese</option>
              <option value="naechste">nächste</option>
              <option value="uebernaechste">übernächste</option>
            </select>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">P2</th>
        <td>
          <input type="number" class="form-control" name="input_dv_2" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input_dv_2_price" value="0.0">
        </td>
        <td>
          <input type="number" class="form-control" name="input_dv_2_penalty" value="0.0">
        </td>
        <td>
          <div class="form-group">
            <select class="form-control" id="p2" name="auslieferungsPeriode_2" value="0">
              <option>diese </option>
              <option>nächste</option>
              <option>übernächste</option>
            </select>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">P3</th>
        <td>
          <input type="number" class="form-control" name="input_dv_3" value="0">
        </td>
        <td>
          <input type="number" class="form-control" name="input_dv_3_price" value="0.0">
        </td>
        <td>
          <input type="number" class="form-control" name="input_dv_3_penalty" value="0.0">
        </td>
        <td>
          <div class="form-group">
            <select class="form-control" id="p3" name="auslieferungsPeriode_3">
              <option>diese </option>
              <option>nächste</option>
              <option>übernächste</option>
            </select>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <input type="submit">
</form>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>