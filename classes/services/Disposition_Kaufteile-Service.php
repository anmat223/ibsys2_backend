<?php
class DispositionKaufteileService
{

  function alleBestellungenBerechnen($kaufteile, $produktionsprogramm) {
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

    $bruttobedarfPeriode1 = $kaufteil->verwendungP1 * $produktionsprogramm->periode1->p1;
    $bruttobedarfPeriode1 += $kaufteil->verwendungP2 * $produktionsprogramm->periode1->p2;
    $bruttobedarfPeriode1 += $kaufteil->verwendungP3 * $produktionsprogramm->periode1->p3;

    $bruttobedarfPeriode2 = $kaufteil->verwendungP1 * $produktionsprogramm->periode2->p1;
    $bruttobedarfPeriode2 += $kaufteil->verwendungP2 * $produktionsprogramm->periode2->p2;
    $bruttobedarfPeriode2 += $kaufteil->verwendungP3 * $produktionsprogramm->periode2->p3;

    $bruttobedarfPeriode3 = $kaufteil->verwendungP1 * $produktionsprogramm->periode3->p1;
    $bruttobedarfPeriode3 += $kaufteil->verwendungP2 * $produktionsprogramm->periode3->p2;
    $bruttobedarfPeriode3 += $kaufteil->verwendungP3 * $produktionsprogramm->periode3->p3;

    $bruttobedarfPeriode4 = $kaufteil->verwendungP1 * $produktionsprogramm->periode4->p1;
    $bruttobedarfPeriode4 += $kaufteil->verwendungP2 * $produktionsprogramm->periode4->p2;
    $bruttobedarfPeriode4 += $kaufteil->verwendungP3 * $produktionsprogramm->periode4->p3;

    $endbestand = $kaufteil->anzahl - $bruttobedarfPeriode1;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferzeit + $kaufteil->abweichung) > 1)
        $bestellung = new Bestellung(new Periode(1), $kaufteil, true, $kaufteil->diskontmenge);
      else {
        $bestellung = new Bestellung(new Periode(1), $kaufteil, false, $kaufteil->diskontmenge);
      }
    }

    $endbestand -= $bruttobedarfPeriode2;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferfrist + $kaufteil->abweichung) > 2)
        $bestellung = new Bestellung(new Periode(2), $kaufteil, true, $kaufteil->diskontmenge);
      else {
        $bestellung = new Bestellung(new Periode(2), $kaufteil, false, $kaufteil->diskontmenge);
      }
    }

    $endbestand -= $bruttobedarfPeriode3;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferfrist + $kaufteil->abweichung) > 3)
        $bestellung = new Bestellung(new Periode(3), $kaufteil, true, $kaufteil->diskontmenge);
      else {
        $bestellung = new Bestellung(new Periode(3), $kaufteil, false, $kaufteil->diskontmenge);
      }
    }

    $endbestand -= $bruttobedarfPeriode4;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferfrist + $kaufteil->abweichung) > 4)
        $bestellung = new Bestellung(new Periode(4), $kaufteil, true, $kaufteil->diskontmenge);
      else {
        $bestellung = new Bestellung(new Periode(4), $kaufteil, false, $kaufteil->diskontmenge);
      }
    }

    return $bestellung;
  }
}
