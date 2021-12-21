<?php
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/classes/services/Database_Service.php');
require_once($documentRoot . '/classes/entities/Produktionsteil.php');

$database = new DatabaseService();

$nummernp1 = [1, 51, 50, 4, 10, 49, 7, 13, 18];
$nummernp2 = [2, 56, 55, 5, 11, 54, 8, 14, 19];
$nummernp3 = [3, 31, 30, 6, 12, 29, 9, 15, 20];

$produktionsauftraege = $_SESSION['produktionsauftraege'];
$splitting = $_SESSION['splits'];
$newprod = [];

foreach ($produktionsauftraege as $key => $teil) {
  if ($key == 26 || $key == 16 || $key == 17) {
    $newprod[$key][0] = $produktionsauftraege[$key][0];
    $newprod[$key][1] = $splitting[$key];
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
    $newprod[$key][0] = $produktionsauftraege[$key];
    $newprod[$key][1] = $splitting[$key];
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
    $newprod[$key][0] = $produktionsauftraege[$key];
    $newprod[$key][1] = $splitting[$key];
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
    $newprod[$key][0] = $produktionsauftraege[$key];
    $newprod[$key][1] = $splitting[$key];
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
    $teil->produktionsAuftragp1 = $produktionsauftraege[$teil->nummer][1];
  } else {
    $teil->produktionsAuftrag = $produktionsauftraege[$teil->nummer];
  }
  $teil->splitting = $splitting[$teil->nummer];
}

foreach ($teilep2 as $teil) {
  if ($teil->dreifach) {
    $teil->produktionsAuftragp2 = $produktionsauftraege[$teil->nummer][2];
  } else {
    $teil->produktionsAuftrag = $produktionsauftraege[$teil->nummer];
  }
  $teil->splitting = $splitting[$teil->nummer];
}

foreach ($teilep3 as $teil) {
  if ($teil->dreifach) {
    $teil->produktionsAuftragp3 = $produktionsauftraege[$teil->nummer][3];
  } else {
    $teil->produktionsAuftrag = $produktionsauftraege[$teil->nummer];
  }
  $teil->splitting = $splitting[$teil->nummer];
}

$_SESSION['produktionsteile'][0] = $teilep1;
$_SESSION['produktionsteile'][1] = $teilep2;
$_SESSION['produktionsteile'][2] = $teilep3;

header('Location: reihenfolgePlanung.php');
