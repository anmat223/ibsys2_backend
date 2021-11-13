<?php
class DispositionKaufteileService {

  function bestellungBerechnen($kaufteil) {
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

    $endbestand = $kaufteil->anfangsbestand - $bruttobedarfPeriode1;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferfrist + $kaufteil->lieferabweichung) > 1)
        new Bestellung($kaufteil->nummer, $kaufteil->diskontmenge, "E");
      else {
        new Bestellung($kaufteil->nummer, $kaufteil->diskontmenge, "N");
      }
    }

    $endbestand -= $bruttobedarfPeriode2;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferfrist + $kaufteil->lieferabweichung) > 2)
        new Bestellung($kaufteil->nummer, $kaufteil->diskontmenge, "E");
      else {
        new Bestellung($kaufteil->nummer, $kaufteil->diskontmenge, "N");
      }
    }

    $endbestand -= $bruttobedarfPeriode3;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferfrist + $kaufteil->lieferabweichung) > 3)
        new Bestellung($kaufteil->nummer, $kaufteil->diskontmenge, "E");
      else {
        new Bestellung($kaufteil->nummer, $kaufteil->diskontmenge, "N");
      }
    }

    $endbestand -= $bruttobedarfPeriode4;

    if ($endbestand <= $kaufteil->diskontmenge) {
      if (($kaufteil->lieferfrist + $kaufteil->lieferabweichung) > 4)
        new Bestellung($kaufteil->nummer, $kaufteil->diskontmenge, "E");
      else {
        new Bestellung($kaufteil->nummer, $kaufteil->diskontmenge, "N");
      }
    }

    return $produktionsteil;

  }
}