<?php
class DispositionEigenproduktionService {

  function alleProduktionsauftraegeBerechnen($produktionsteile) {
    $produktion = array();

    foreach ($produktionsteile as $teil) {
      $produktionProTeil = $this->produktionsauftraegeBerechnen($teil);
      array_push($produktion, $produktionProTeil);
    }

    return $produktion;
  }

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