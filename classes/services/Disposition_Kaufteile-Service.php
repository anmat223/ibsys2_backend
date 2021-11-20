<?php
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

    $bruttobedarfPeriode = $kaufteil->verwendungP1 * $produktionsprogramm->p1;
    $bruttobedarfPeriode += $kaufteil->verwendungP2 * $produktionsprogramm->p2;
    $bruttobedarfPeriode += $kaufteil->verwendungP3 * $produktionsprogramm->p3;

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
