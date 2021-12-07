<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

$nummernp1 = [1, 51, 50, 4, 10, 49, 7, 13, 18];
$nummernp2 = [2, 56, 55, 5, 11, 54, 8, 14, 19];
$nummernp3 = [3, 31, 30, 6, 12, 29, 8, 15, 20];

for ($i = 0; $i < count($produktionsauftraege); $i++) {
    $key = key($produktionsauftraege[$i]);
    if ($key == 26 || $key == 16 || $key == 17) {
        $produktionsauftraege[$i] = $_POST['p1' . $key] + $_POST['p2' . $key] + $_POST['p3' . $key];
    }

    if (in_array($key, $nummernp1)) {
        $produktionsauftraege[$i] = $_POST['p1' . $key];
    } elseif (in_array($key, $nummernp2)) {
        $produktionsauftraege[$i] = $_POST['p2' . $key];
    } else {
        $produktionsauftraege[$i] = $_POST['p3' . $key];
    }
}

$_SESSION['produktionsauftrage'] = $produktionsauftraege;

header('Location: kapazitaetsplan.php');