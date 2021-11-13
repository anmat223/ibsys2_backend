<?php
class DispositionEigenproduktionService {

  function produktionsauftraegeBerechnen($produktionsteil) {
    $verbindlicheAuftraege = $produktionsteil->verbindlicheAuftraege;
    $sicherheitsbestand = $produktionsteil->sicherheitsbestand;
    $lagerbestandEndeVorperiode = $produktionsteil->lagerbestand;
    $auftraegeWarteschlange = $produktionsteil->auftraegeWarteschlange;
    $auftraegeBearbeitung = $produktionsteil->auftraegeBearbeitung;

    $produktionsauftraegeKommendePeriode = $verbindlicheAuftraege + $sicherheitsbestand;
    $produktionsauftraegeKommendePeriode -= ($lagerbestandEndeVorperiode + $auftraegeWarteschlange + $auftraegeBearbeitung);

    $produktionsteil->produktionsauftraegeKommendePeriode = $produktionsauftraegeKommendePeriode;

    return $produktionsteil;
  }
}