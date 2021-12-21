<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Produktionsteil.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

$nummernp1 = [1, 51, 50, 4, 10, 49, 7, 13, 18];
$nummernp2 = [2, 56, 55, 5, 11, 54, 8, 14, 19];
$nummernp3 = [3, 31, 30, 6, 12, 29, 9, 15, 20];

$produktionsauftraege = $_SESSION['produktionsauftraege'];
$newprod = [];

foreach ($produktionsauftraege as $key => $teil) {
  if ($key == 26 || $key == 16 || $key == 17) {
    $newprod[$key][0] = $_POST['p1' . $key] + $_POST['p2' . $key] + $_POST['p3' . $key];
    $newprod[$key][1] = $_POST['s' . $key];
    $split = floor($newprod[$key][0] / $newprod[$key][1]);
    $splits = [];
    $summe = 0;
    for ($i = 0; $i < $newprod[$key][1]; $i++) {
      $summe += $split;
      if ($i == $newprod[$key][1] - 1 && $summe != $newprod[$key][0]) {
        array_push($splits, $split + ($newprod[$key][0] - $summe));
      } else {
        array_push($splits, $split);
      }
    }
    $newprod[$key][2] = $splits;
    continue;
  }

  if (in_array($key, $nummernp1)) {
    $newprod[$key][0] = $_POST['p1' . $key];
    $newprod[$key][1] = $_POST['s' . $key];
    $split = floor($newprod[$key][0] / $newprod[$key][1]);
    $splits = [];
    $summe = 0;
    for ($i = 0; $i < $newprod[$key][1]; $i++) {
      $summe += $split;
      if ($i == $newprod[$key][1] - 1 && $summe != $newprod[$key][0]) {
        array_push($splits, $split + ($newprod[$key][0] - $summe));
      } else {
        array_push($splits, $split);
      }
    }
    $newprod[$key][2] = $splits;
  } elseif (in_array($key, $nummernp2)) {
    $newprod[$key][0] = $_POST['p2' . $key];
    $newprod[$key][1] = $_POST['s' . $key];
    $split = floor($newprod[$key][0] / $newprod[$key][1]);
    $splits = [];
    $summe = 0;
    for ($i = 0; $i < $newprod[$key][1]; $i++) {
      $summe += $split;
      if ($i == $newprod[$key][1] - 1 && $summe != $newprod[$key][0]) {
        array_push($splits, $split + ($newprod[$key][0] - $summe));
      } else {
        array_push($splits, $split);
      }
    }
    $newprod[$key][2] = $splits;
  } else {
    $newprod[$key][0] = $_POST['p3' . $key];
    $newprod[$key][1] = $_POST['s' . $key];
    $split = floor($newprod[$key][0] / $newprod[$key][1]);
    $splits = [];
    $summe = 0;
    for ($i = 0; $i < $newprod[$key][1]; $i++) {
      $summe += $split;
      if ($i == $newprod[$key][1] - 1 && $summe != $newprod[$key][0]) {
        array_push($splits, $split + ($newprod[$key][0] - $summe));
      } else {
        array_push($splits, $split);
      }
    }
    $newprod[$key][2] = $splits;
  }
}

$reihenfolge = [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 26, 49, 54, 29, 50, 55, 30, 51, 56, 31, 1, 2, 3];
$prod = [];
foreach ($reihenfolge as $i) {
  $prod[$i] = $newprod[$i];
}

$_SESSION['produktionsauftraege'] = $prod;

if (array_key_exists('checkProduktionsauftraege', $_SESSION)) {
  $_SESSION['checkProduktionsauftraege'] = 1;
} else {
  $_SESSION['checkProduktionsauftraege'] = 0;
}

$teilep1 = $_SESSION['produktionsteile'][0];
$teilep2 = $_SESSION['produktionsteile'][1];
$teilep3 = $_SESSION['produktionsteile'][2];

foreach ($teilep1 as $teil) {
  if ($teil->dreifach) {
    $teil->produktionsAuftragp1 = $_POST['p1' . $teil->nummer];
  } else {
    $teil->produktionsAuftrag = $_POST['p1' . $teil->nummer];
  }
  $teil->splitting = $_POST['s' . $teil->nummer];
}

foreach ($teilep2 as $teil) {
  if ($teil->dreifach) {
    $teil->produktionsAuftragp2 = $_POST['p2' . $teil->nummer];
  } else {
    $teil->produktionsAuftrag = $_POST['p2' . $teil->nummer];
  }
  $teil->splitting = $_POST['s' . $teil->nummer];
}

foreach ($teilep3 as $teil) {
  if ($teil->dreifach) {
    $teil->produktionsAuftragp3 = $_POST['p3' . $teil->nummer];
  } else {
    $teil->produktionsAuftrag = $_POST['p3' . $teil->nummer];
  }
  $teil->splitting = $_POST['s' . $teil->nummer];
}

$_SESSION['produktionsteile'][0] = $teilep1;
$_SESSION['produktionsteile'][1] = $teilep2;
$_SESSION['produktionsteile'][2] = $teilep3;

header('Location: reihenfolgePlanung.php');
