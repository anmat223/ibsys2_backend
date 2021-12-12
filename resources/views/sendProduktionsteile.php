<?php
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/classes/services/Database_Service.php');

$database = new DatabaseService();

$nummernp1 = [1, 51, 50, 4, 10, 49, 7, 13, 18];
$nummernp2 = [2, 56, 55, 5, 11, 54, 8, 14, 19];
$nummernp3 = [3, 31, 30, 6, 12, 29, 8, 15, 20];

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

$_SESSION['produktionsauftraege'] = $newprod;

$_SESSION['checkProduktionsauftraege'] = 0;
header('Location: ./reihenfolgePlanung.php');
