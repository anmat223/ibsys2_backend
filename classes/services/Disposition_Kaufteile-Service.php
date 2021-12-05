<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/entities/Bestellung.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Periode.php');
class DispositionKaufteileService
{

  function alleBestellungenBerechnen($kaufteile, $produktionsprogramm)
  {
    $bestellungen = array();

    foreach ($kaufteile as $teil) {
      $bestellung = $this->bestellungBerechnen($teil, $produktionsprogramm);
      array_push($bestellungen, $bestellung);
    }

    return $bestellungen;
  }

  function bestellungBerechnen($kaufteil, $produktionsprogramm)
  {
    $bestellung = null;

    $bruttobedarfPeriode = $kaufteil->p1 * $produktionsprogramm['p1'];
    $bruttobedarfPeriode += $kaufteil->p2 * $produktionsprogramm['p2'];
    $bruttobedarfPeriode += $kaufteil->p3 * $produktionsprogramm['p3'];

    $endbestand = $kaufteil->anzahl - $bruttobedarfPeriode;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferzeit + $kaufteil->abweichung) > 1)
        $bestellung = new Bestellung(new Periode(1), $kaufteil, true, $kaufteil->diskontmenge);
      else {
        $bestellung = new Bestellung(new Periode(1), $kaufteil, false, $kaufteil->diskontmenge);
      }
    }

    return $bestellung;
  }
}
