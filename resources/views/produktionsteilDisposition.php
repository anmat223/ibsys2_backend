<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

$teilep1 = [];
$teilep2 = [];
$teilep3 = [];

$nummernp1 = [1, 26, 51, 16, 17, 50, 4, 10, 49, 7, 13, 18];
$nummernp2 = [2, 26, 56, 16, 17, 55, 5, 11, 54, 8, 14, 19];
$nummernp3 = [3, 26, 31, 16, 17, 30, 6, 12, 29, 8, 15, 20];

foreach ($p as $teil) {
  $teil->inWarteschlange = 0;
  $teil->inBearbeitung = 0;
  $teil->produktionsAuftrag = 0;

  if (in_array($teil->nummer, $nummernp1)) {
    foreach ($inWarteschlange as $w) {
      if ($teil->nummer == $w->produktionsteil->nummer) {
        $teil->inWarteschlange += $w->anzahl;
      }
    }

    foreach ($wartelisteArbeitsplatz as $w) {
      if ($teil->nummer == $w->produktionsteil->nummer) {
        $teil->inWarteschlange += $w->anzahl;
      }
    }

    foreach ($inBearbeitung as $b) {
      if ($teil->nummer == $b->produktionsteil->nummer) {
        $teil->inBearbeitung += $b->anzahl;
      }
    }

    $teil->produktionsAuftrag += $produktionsauftraege[$teil->nummer];
    array_push($teilep1, $teil);
  }

  if (in_array($teil->nummer, $nummernp2)) {
    foreach ($inWarteschlange as $w) {
      if ($teil->nummer == $w->produktionsteil->nummer) {
        $teil->inWarteschlange += $w->anzahl;
      }
    }

    foreach ($wartelisteArbeitsplatz as $w) {
      if ($teil->nummer == $w->produktionsteil->nummer) {
        $teil->inWarteschlange += $w->anzahl;
      }
    }

    foreach ($inBearbeitung as $b) {
      if ($teil->nummer == $b->produktionsteil->nummer) {
        $teil->inBearbeitung += $b->anzahl;
      }
    }

    $teil->produktionsAuftrag += $produktionsauftraege[$teil->nummer];
    array_push($teilep2, $teil);
  }

  if (in_array($teil->nummer, $nummernp3)) {
    foreach ($inWarteschlange as $w) {
      if ($teil->nummer == $w->produktionsteil->nummer) {
        $teil->inWarteschlange += $w->anzahl;
      }
    }

    foreach ($wartelisteArbeitsplatz as $w) {
      if ($teil->nummer == $w->produktionsteil->nummer) {
        $teil->inWarteschlange += $w->anzahl;
      }
    }

    foreach ($inBearbeitung as $b) {
      if ($teil->nummer == $b->produktionsteil->nummer) {
        $teil->inBearbeitung += $b->anzahl;
      }
    }

    $teil->produktionsAuftrag += $produktionsauftraege[$teil->nummer];
    array_push($teilep3, $teil);
  }
}

?>
<h2>produktionsteildisposition</h2>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#p1" type="button" role="tab" aria-controls="nav-home" aria-selected="true">P1</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#p2" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">P2</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#p3" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">P3</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="p1" role="tabpanel" aria-labelledby="nav-home-tab">
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
  <div id="p2" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-profile-tab">
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
  <div id="p3" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-contact-tab">
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