<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/entities/Bestellung.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Periode.php');
class DispositionKaufteileService
{

  function berechnungBestellung($kaufteile)
  {
    $bestellungen = [];
    foreach ($kaufteile as $teil) {
      // Variablen befüllen
      $lieferzeit = $teil->lieferzeit + $teil->abweichung;

      $produktionsprogrammP1 = $_SESSION['produktionsprogrammMitPrognosen'][0];
      $p1 =  $teil->p1 * $produktionsprogrammP1[0] + $teil->p2 * $produktionsprogrammP1[1] + $teil->p3 * $produktionsprogrammP1[2];

      $produktionsprogrammP2 = $_SESSION['produktionsprogrammMitPrognosen'][1];
      $p2 = $teil->p1 * $produktionsprogrammP2[0] + $teil->p2 * $produktionsprogrammP2[1] + $teil->p3 * $produktionsprogrammP2[2];

      $produktionsprogrammP3 = $_SESSION['produktionsprogrammMitPrognosen'][2];
      $p3 = $teil->p1 * $produktionsprogrammP3[0] + $teil->p2 * $produktionsprogrammP3[1] + $teil->p3 * $produktionsprogrammP3[2];

      $produktionsprogrammP4 = $_SESSION['produktionsprogrammMitPrognosen'][3];
      $p4 = $teil->p1 * $produktionsprogrammP4[0] + $teil->p2 * $produktionsprogrammP4[1] + $teil->p3 * $produktionsprogrammP4[2];

      //Berechnung
      $differenz = $teil->anzahl - $p1;
      if ($differenz <= 0) {
        if ($lieferzeit < 1) {
          array_push($bestellungen, array($teil->diskontmenge, "N"));
        } else {
          array_push($bestellungen, array($teil->diskontmenge, "E"));
        }
      } else {
        $differenz = $teil->anzahl - $p2;
        if ($differenz <= 0) {
          if ($lieferzeit < 2) {
            if ($lieferzeit <= 1) {
              array_push($bestellung, array(0, "N"));
            } else {
              array_push($bestellungen, array($teil->diskontmenge, "N"));
            }
          } else {
            array_push($bestellungen, array($teil->diskontmenge, "E"));
          }
        } else {
          $differenz = $teil->anzahl - $p3;
          if ($differenz <= 0) {
            if ($lieferzeit < 3) {
              if ($lieferzeit <= 2) {
                array_push($bestellung, array(0, "N"));
              } else {
                array_push($bestellungen, array($teil->diskontmenge, "N"));
              }
            } else {
              array_push($bestellungen, array($teil->diskontmenge, "E"));
            }
          } else {
            $differenz = $teil->anzahl - $p4;
            if ($differenz <= 0) {
              if ($lieferzeit < 4) {
                if ($lieferzeit <= 3) {
                  array_push($bestellung, array(0, "N"));
                } else {
                  array_push($bestellungen, array($teil->diskontmenge, "N"));
                }
              } else {
                array_push($bestellungen, array($teil->diskontmenge, "E"));
              }
            } else {
              array_push($bestellungen, array(0, "N"));
            }
          }
        }
      }
    }
    return $bestellungen;
  }
}
