<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/navbar.php');

$alleAuftraege = $_SESSION['alleAuftraege'];

for ($i = 0; $i < count($alleAuftraege); $i++) {
  $alleAuftraege[$i][2] = $_POST['prio' . $i];
}

function cmp($a, $b)
{
  if ($a[2] > $b[2]) {
    return 1;
  } elseif ($a[2] < $b[2]) {
    return -1;
  }
  return 0;
}

usort($alleAuftraege, "cmp");

$_SESSION['alleAuftraege'] = $alleAuftraege;
header('Location: kapazitaetsplan.php');
