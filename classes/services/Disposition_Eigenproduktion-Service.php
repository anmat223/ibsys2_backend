<?php
class DispositionEigenproduktionService
{

  private $produktionsauftraege = array();

  function alleProduktionsauftraegeBerechnen($produktionsteile, $wartendeArtikel)
  {
    $produktion = array();

    foreach ($produktionsteile as $teil) {
      $produktionProTeil = $this->produktionsauftraegeGet($teil, $wartendeArtikel);
      $produktion[$teil->nummer] = $produktionProTeil;
    }

    return $produktion;
  }

  function produktionsauftraegeGet($produktionsteil, $wartendeArtikel)
  {
    $nummer = $produktionsteil->nummer;
    $verbindlicheAuftraege = 0;

    if ($nummer == 26) {
      $verbindlicheAuftraege = $this->produktionsauftraege[1] + $this->produktionsauftraege[2] + $this->produktionsauftraege[3];
    } elseif ($nummer == 16 || $nummer == 17) {
      $verbindlicheAuftraege = $this->produktionsauftraege[51] + $this->produktionsauftraege[56] + $this->produktionsauftraege[31];
    } elseif ($nummer == 50) {
      $verbindlicheAuftraege = $this->produktionsauftraege[51];
    } elseif ($nummer == 51) {
      $verbindlicheAuftraege = $this->produktionsauftraege[1];
    } elseif ($nummer == 4 || $nummer == 10 || $nummer == 49) {
      $verbindlicheAuftraege = $this->produktionsauftraege[50];
    } elseif ($nummer == 7 || $nummer == 13 || $nummer == 18) {
      $verbindlicheAuftraege = $this->produktionsauftraege[49];
    } elseif ($nummer == 56) {
      $verbindlicheAuftraege = $this->produktionsauftraege[2];
    } elseif ($nummer == 55) {
      $verbindlicheAuftraege = $this->produktionsauftraege[56];
    } elseif ($nummer == 5 || $nummer == 11 || $nummer == 54) {
      $verbindlicheAuftraege = $this->produktionsauftraege[55];
    } elseif ($nummer == 8 || $nummer == 14 || $nummer == 19) {
      $verbindlicheAuftraege = $this->produktionsauftraege[54];
    } elseif ($nummer == 31) {
      $verbindlicheAuftraege = $this->produktionsauftraege[3];
    } elseif ($nummer == 30) {
      $verbindlicheAuftraege = $this->produktionsauftraege[31];
    } elseif ($nummer == 6 || $nummer == 12 || $nummer == 29) {
      $verbindlicheAuftraege = $this->produktionsauftraege[30];
    } elseif ($nummer == 9 || $nummer == 15 || $nummer == 20) {
      $verbindlicheAuftraege = $this->produktionsauftraege[29];
    }

    $sicherheitsbestand = $produktionsteil->sicherheitsbestand;
    $lagerbestandEndeVorperiode = $produktionsteil->anzahl;

    $auftraegeBearbeitung = null;
    $auftraegeWarteschlange = null;

    foreach ($wartendeArtikel as $artikel) {
      if ($artikel->produktionsteil->nummer == $produktionsteil->nummer) {
        if ($artikel->inBearbeitung) {
          $auftraegeBearbeitung = $artikel->anzahl;
        } else {
          $auftraegeWarteschlange = $artikel->anzahl;
        }
      }
    }

    $auftragsmenge = $verbindlicheAuftraege + $sicherheitsbestand;
    $auftragsmenge -= ($lagerbestandEndeVorperiode + $auftraegeWarteschlange + $auftraegeBearbeitung);

    $this->produktionsauftraege[$produktionsteil->nummer] = $auftragsmenge;

    return $auftragsmenge;
  }
}
