<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Produktionsteil.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

$eigenproduktionsService = new DispositionEigenproduktionService();
$produktionsauftraege = $eigenproduktionsService->alleProduktionsauftraegeBerechnen($p, $warteliste);
$_SESSION['produktionsauftraege'] = $produktionsauftraege;

$teilep1 = [];
$teilep2 = [];
$teilep3 = [];

$nummernp1 = [1, 26, 51, 16, 17, 50, 4, 10, 49, 7, 13, 18];
$nummernp2 = [2, 26, 56, 16, 17, 55, 5, 11, 54, 8, 14, 19];
$nummernp3 = [3, 26, 31, 16, 17, 30, 6, 12, 29, 9, 15, 20];

if (!array_key_exists('produktionsteile', $_SESSION) || $_SESSION["sb"] = 1) {
  $_SESSION["sb"] = 0;
  foreach ($p as $teil) {
    $teil->inWarteschlange = 0;
    $teil->inBearbeitung = 0;
    $teil->produktionsAuftrag = 0;

    if ($teil->dreifach) {
      $teil->produktionsAuftragp2 = 0;
      $teil->produktionsAuftragp2 = 0;
      $teil->produktionsAuftragp3 = 0;
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

      $teil->produktionsAuftrag += $produktionsauftraege[$teil->nummer][0];
      $teil->produktionsAuftragp1 += $produktionsauftraege[$teil->nummer][1];
      $teil->produktionsAuftragp2 += $produktionsauftraege[$teil->nummer][2];
      $teil->produktionsAuftragp3 += $produktionsauftraege[$teil->nummer][3];
      array_push($teilep1, $teil);
      array_push($teilep2, $teil);
      array_push($teilep3, $teil);
    } elseif (in_array($teil->nummer, $nummernp1)) {
      $teil->produktionsAuftrag = 0;
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
    } elseif (in_array($teil->nummer, $nummernp2)) {

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
    } elseif (in_array($teil->nummer, $nummernp3)) {
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
  $_SESSION['produktionsteile'] = array($teilep1, $teilep2, $teilep3);
} else {
    $teilep1 = $_SESSION['produktionsteile'][0];
    $teilep2 = $_SESSION['produktionsteile'][1];
    $teilep3 = $_SESSION['produktionsteile'][2];
}
?>
<h2><?php if ($_SESSION['language'] == "DE") {
      echo "Produktionsteildisposition";
    } else {
      echo "Production Parts Scheduling";
    }
    ?></h2>
<br>
<form action="writeDatabase.php" method="post">
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#p1" type="button" role="tab" aria-controls="nav-home" aria-selected="true">P1</button>
      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#p2" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">P2</button>
      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#p3" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">P3</button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="p1" role="tabpanel" aria-labelledby="nav-home-tab">
      <br>
      <h3>Disposition Eigenfertigung P1</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" data-editable="true">Produktionsteil</th>
            <th scope="col">Sicherheitsbestand</th>
            <th scope="col">Lagerbestand am Ende der Vorperiode</th>
            <th scope="col">Aufträge in der Warteschlange</th>
            <th scope="col">Aufträge in Bearbeitung</th>
            <th scope="col">Produktions-Aufträge für die kommende Periode</th>
            <th scope="col">Anzahl Splitting</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($teilep1 as $teil) : ?>
            <tr>
              <th scope="row"><?php echo $teil->nummer; ?></th>
              <td><input type="number" class="form-control" name="<?php echo "sb" . $teil->nummer ?>" value="<?php echo $teil->sicherheitsbestand;?>" onchange="validate(this.value, this.name)"></td>
              <td><?php echo $teil->anzahl; ?></td>
              <td><?php echo $teil->inWarteschlange; ?></td>
              <td><?php echo $teil->inBearbeitung; ?></td>
              <td><?php echo ($teil->dreifach) ? $teil->produktionsAuftragp1 : $teil->produktionsAuftrag; ?></td>
              <td><input type="number" class=" from-control" name="<?php echo "s" . $teil->nummer ?>" value="<?php echo ($teil->splitting)?: 1; ?>" onchange="validateSplitting(this.value, this.name)"></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div id="p2" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-profile-tab">
      <br>
      <h3>Disposition Eigenfertigung P2</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" data-editable="true">Produktionsteil</th>
            <th scope="col">Sicherheitsbestand</th>
            <th scope="col">Lagerbestand am Ende der Vorperiode</th>
            <th scope="col">Aufträge in der Warteschlange</th>
            <th scope="col">Aufträge in Bearbeitung</th>
            <th scope="col">Produktions-Aufträge für die kommende Periode</th>
            <th scope="col">Anzahl Splitting</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($teilep2 as $teil) : ?>
            <tr>
              <th scope="row"><?php echo $teil->nummer; ?></th>
              <td><input type="number" class="form-control" name="<?php echo "sb" . $teil->nummer ?>" value="<?php echo $teil->sicherheitsbestand;?>" onchange="validate(this.value, this.name)"></td>
              <td><?php echo $teil->anzahl; ?></td>
              <td><?php echo $teil->inWarteschlange; ?></td>
              <td><?php echo $teil->inBearbeitung; ?></td>
              <td><?php echo "p2" . $teil->nummer ?>" value="<?php echo ($teil->dreifach) ? $teil->produktionsAuftragp2 : $teil->produktionsAuftrag; ?></td>
              <td><input type="number" class=" from-control" name="<?php echo "s" . $teil->nummer ?>" value="<?php echo ($teil->splitting)?: 1; ?>" onchange="validateSplitting(this.value, this.name)"></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div id="p3" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-contact-tab">
      <br>
      <h3>Disposition Eigenfertigung P3</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" data-editable="true">Produktionsteil</th>
            <th scope="col">Sicherheitsbestand</th>
            <th scope="col">Lagerbestand am Ende der Vorperiode</th>
            <th scope="col">Aufträge in der Warteschlange</th>
            <th scope="col">Aufträge in Bearbeitung</th>
            <th scope="col">Produktions-Aufträge für die kommende Periode</th>
            <th scope="col">Anzahl Splitting</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($teilep3 as $teil) : ?>
            <tr>
              <th scope="row"><?php echo $teil->nummer; ?></th>
              <td><input type="number" class="form-control" name="<?php echo "sb" . $teil->nummer ?>" value="<?php echo $teil->sicherheitsbestand;?>" onchange="validate(this.value, this.name)"></td>
              <td><?php echo $teil->anzahl; ?></td>
              <td><?php echo $teil->inWarteschlange; ?></td>
              <td><?php echo $teil->inBearbeitung; ?></td>
              <td><?php echo "p3" . $teil->nummer ?>" value="<?php echo ($teil->dreifach) ? $teil->produktionsAuftragp3 : $teil->produktionsAuftrag; ?> </td>
              <td><input type="number" class=" from-control" name="<?php echo "s" . $teil->nummer ?>" value="<?php echo ($teil->splitting)?: 1; ?>" onchange="validateSplitting(this.value, this.name)"></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <input type="submit" class="btn btn-dark" value="validate">
</form>
<form action="sendProduktionsteile.php">
  <input type="submit" class="btn btn-dark">
</form>
<script>
  function validate(value, name) {
    if (document.getElementsByName(name)[0].value.length !== 0) {
      if (value < 0) {
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
  function validateSplitting(value, name) {
      if (document.getElementsByName(name)[0].value.length !== 0) {
          if (value < 1) {
              alert('Der Wert darf nicht kleiner als 1 sein!')
              document.getElementsByName(name)[0].value = 1
          }
          let strValue = String(value)
          let split = strValue.split('.')
          if (split.length > 1) {
              alert('Der Wert darf keine Nachkommastelle haben!')
              document.getElementsByName(name)[0].value = 1
          } else {
              return
          }
      } else {
          document.getElementsByName(name)[0].value = 1
      }
  }
</script>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>