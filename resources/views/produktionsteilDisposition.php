<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="container">
  <h2>produktionsteildisposition</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#p1">P1</a></li>
    <li><a data-toggle="tab" href="#p2">P2</a></li>
    <li><a data-toggle="tab" href="#p3">P3</a></li>
  </ul>

  <div class="tab-content">
    <div id="p1" class="tab-pane fade in active">
      <h3>Disposition Eigenfertigung P1</h3>
      <div class="container">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" data-editable="true">Produktionsteil</th>
              <th scope="col">Vertriebswunsch/ verbindliche Aufträge</th>
              <th scope="col">Sicherheitsbestand</th>
              <th scope="col">Lagerbestand am Ende der Vorperiode (gesamt)</th>
              <th scope="col">Lagerbestand am Ende der Vorperiode</th>
              <th scope="col">Aufträge in der Warteschlange</th>
              <th scope="col">Aufträge in Bearbeitung</th>
              <th scope="col">Produktions-Aufträge für die kommende Periode</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">P1</th>
              <td>John</td>
              <td>Doe</td>
              <td>john@example.com</td>
            </tr>
            <tr>
              <td>Mary</td>
              <td>Moe</td>
              <td>mary@example.com</td>
            </tr>
            <tr>
              <td>July</td>
              <td>Dooley</td>
              <td>july@example.com</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div id="p2" class="tab-pane fade">
      <h3>Disposition Eigenfertigung P2</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" data-editable="true">Produktionsteil</th>
            <th scope="col">Vertriebswunsch/ verbindliche Aufträge</th>
            <th scope="col">Sicherheitsbestand</th>
            <th scope="col">Lagerbestand am Ende der Vorperiode (gesamt)</th>
            <th scope="col">Lagerbestand am Ende der Vorperiode</th>
            <th scope="col">Aufträge in der Warteschlange</th>
            <th scope="col">Aufträge in Bearbeitung</th>
            <th scope="col">Produktions-Aufträge für die kommende Periode</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">P1</th>
            <td>John</td>
            <td>Doe</td>
            <td>john@example.com</td>
          </tr>
          <tr>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
          </tr>
          <tr>
            <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="p3" class="tab-pane fade">
      <h3>Disposition Eigenfertigung P3</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" data-editable="true">Produktionsteil</th>
            <th scope="col">Vertriebswunsch/ verbindliche Aufträge</th>
            <th scope="col">Sicherheitsbestand</th>
            <th scope="col">Lagerbestand am Ende der Vorperiode (gesamt)</th>
            <th scope="col">Lagerbestand am Ende der Vorperiode</th>
            <th scope="col">Aufträge in der Warteschlange</th>
            <th scope="col">Aufträge in Bearbeitung</th>
            <th scope="col">Produktions-Aufträge für die kommende Periode</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">P3</th>
          </tr>
          <tr>
          <td>E26*</td>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
          </tr>
          <tr>
          <td>31</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>16*</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>17*</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>31</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>30*</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>6</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>12</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>29</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>9</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>15</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
          <td>20</td>
             <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<form action="kapazitaetsplan.php" method="post">
  <input type="submit">
</form>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>