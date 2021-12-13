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

    if ($nummer == 1) {
      $verbindlicheAuftraege = $_SESSION['produktionsprogramm'][0];
    }
    if ($nummer == 2) {
      $verbindlicheAuftraege = $_SESSION['produktionsprogramm'][1];
    }
    if ($nummer == 3) {
      $verbindlicheAuftraege = $_SESSION['produktionsprogramm'][2];
    }

    if ($nummer == 26) {
      $verbindlicheAuftraege = $this->produktionsauftraege[1][0] + $this->produktionsauftraege[1][1] + $this->produktionsauftraege[2][0] + $this->produktionsauftraege[2][1] + $this->produktionsauftraege[3][0] + $this->produktionsauftraege[3][1];
    } elseif ($nummer == 16 || $nummer == 17) {
      $verbindlicheAuftraege = $this->produktionsauftraege[51][0] + $this->produktionsauftraege[51][1] + $this->produktionsauftraege[56][0] + $this->produktionsauftraege[56][1] + $this->produktionsauftraege[31][0] + $this->produktionsauftraege[31][1];
    } elseif ($nummer == 50) {
      $verbindlicheAuftraege = $this->produktionsauftraege[51][0] + $this->produktionsauftraege[51][1];
    } elseif ($nummer == 51) {
      $verbindlicheAuftraege = $this->produktionsauftraege[1][0] + $this->produktionsauftraege[1][1];
    } elseif ($nummer == 4 || $nummer == 10 || $nummer == 49) {
      $verbindlicheAuftraege = $this->produktionsauftraege[50][0] + $this->produktionsauftraege[50][1];
    } elseif ($nummer == 7 || $nummer == 13 || $nummer == 18) {
      $verbindlicheAuftraege = $this->produktionsauftraege[49][0] + $this->produktionsauftraege[49][1];
    } elseif ($nummer == 56) {
      $verbindlicheAuftraege = $this->produktionsauftraege[2][0] + $this->produktionsauftraege[2][1];
    } elseif ($nummer == 55) {
      $verbindlicheAuftraege = $this->produktionsauftraege[56][0] + $this->produktionsauftraege[56][1];
    } elseif ($nummer == 5 || $nummer == 11 || $nummer == 54) {
      $verbindlicheAuftraege = $this->produktionsauftraege[55][0] + $this->produktionsauftraege[55][1];
    } elseif ($nummer == 8 || $nummer == 14 || $nummer == 19) {
      $verbindlicheAuftraege = $this->produktionsauftraege[54][0] + $this->produktionsauftraege[54][1];
    } elseif ($nummer == 31) {
      $verbindlicheAuftraege = $this->produktionsauftraege[3][0] + $this->produktionsauftraege[3][1];
    } elseif ($nummer == 30) {
      $verbindlicheAuftraege = $this->produktionsauftraege[31][0] + $this->produktionsauftraege[31][1];
    } elseif ($nummer == 6 || $nummer == 12 || $nummer == 29) {
      $verbindlicheAuftraege = $this->produktionsauftraege[30][0] + $this->produktionsauftraege[30][1];
    } elseif ($nummer == 9 || $nummer == 15 || $nummer == 20) {
      $verbindlicheAuftraege = $this->produktionsauftraege[29][0] + $this->produktionsauftraege[29][1];
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
    $auftragsmenge -= $lagerbestandEndeVorperiode;
    $auftragsmenge -= $auftraegeWarteschlange;
    $auftragsmenge -= $auftraegeBearbeitung;

    $this->produktionsauftraege[$produktionsteil->nummer][0] = $auftragsmenge;
    $this->produktionsauftraege[$produktionsteil->nummer][1] = $auftraegeWarteschlange;
    $this->produktionsauftraege[$produktionsteil->nummer][2] = $auftraegeBearbeitung;

    return $auftragsmenge;
  }
}
