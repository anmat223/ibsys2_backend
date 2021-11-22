<?php
class DispositionEigenproduktionService
{

  function alleProduktionsauftraegeBerechnen($produktionsteile, $wartendeArtikel)
  {
    $produktion = array();

    usort($produktionsteile, "produktionsteileVergleichen");

    foreach ($produktionsteile as $teil) {
      $produktionProTeil = $this->produktionsauftraegeBerechnen($teil, $wartendeArtikel);
      array_push($produktion, $produktionProTeil);
    }

    return $produktion;
  }

  function produktionsauftraegeBerechnen($produktionsteil, $wartendeArtikel)
  {
    // Berechnung der verbindlichen Auftraege muss noch besprochen werden
    $verbindlicheAuftraege = $produktionsteil->verbindlicheAuftraege;
    $sicherheitsbestand = $produktionsteil->sicherheitsbestand;
    $lagerbestandEndeVorperiode = $produktionsteil->anzahl;

    $auftraegeBearbeitung = null;
    $auftraegeWarteschlange = null;

    foreach ($wartendeArtikel as $artikel) {
      if ($artikel->nummer == $produktionsteil->nummer) { // müsste glaub ich $artikel->$produktionsteil->$nummer sein
        if ($artikel->inBearbeitung) {
          $auftraegeBearbeitung = $artikel->anzahl;
        } else {
          $auftraegeWarteschlange = $artikel->anzahl;
        }
      }
    }

    $auftragsmenge = $verbindlicheAuftraege + $sicherheitsbestand;
    $auftragsmenge -= ($lagerbestandEndeVorperiode + $auftraegeWarteschlange + $auftraegeBearbeitung);

    return $auftragsmenge;
  }

  function produktionsteileVergleichen($a, $b)
  {
    if ($a->nummer == $b->nummer) {
      return 0;
    }

    return ($a->nummer < $b->nummer) ? -1 : 1;
  }
}
