<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/entities/Bestellung.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Periode.php');
class DispositionKaufteileService
{

  function berechnungBestellung($kaufteile, $eB)
  {
    $bestellungen = [];
    foreach ($kaufteile as $teil) {
      $verbleibendeLieferzeit = 0;
      $counter = 0;
      foreach ($eB as $e) {
        if ($e[0][0] == $teil->nummer) {
          $verbleibendeLieferzeit = $e[1];
          $counter += 1;
        }
      }

      if ($counter > 1) {
        array_push($bestellungen, array(0, "N"));
        continue;
      }
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
        $differenz = $differenz - $p2;
        if ($differenz <= 0) {
          if ($lieferzeit < 2) {
            if ($lieferzeit <= 1 || $verbleibendeLieferzeit != 0) {
              array_push($bestellungen, array(0, "N"));
            } else {
              array_push($bestellungen, array($teil->diskontmenge, "N"));
            }
          } elseif (($teil->lieferzeit / 2) < $verbleibendeLieferzeit && $verbleibendeLieferzeit != 0) {
            array_push($bestellungen, array($teil->diskontmenge, "E"));
          } elseif ($verbleibendeLieferzeit == 0) {
            array_push($bestellungen, array($teil->diskontmenge, "E"));
          } else {
            array_push($bestellungen, array(0, "N"));
          }
        } else {
          $differenz = $differenz - $p3;
          if ($differenz <= 0) {
            if ($lieferzeit < 3) {
              if ($lieferzeit <= 2 || $verbleibendeLieferzeit != 0) {
                array_push($bestellungen, array(0, "N"));
              } else {
                array_push($bestellungen, array($teil->diskontmenge, "N"));
              }
            } elseif (($teil->lieferzeit / 2) < $verbleibendeLieferzeit && $verbleibendeLieferzeit != 0) {
              array_push($bestellungen, array($teil->diskontmenge, "E"));
            } elseif ($verbleibendeLieferzeit == 0) {
              array_push($bestellungen, array($teil->diskontmenge, "E"));
            } else {
              array_push($bestellungen, array(0, "N"));
            }
          } else {
            $differenz = $differenz - $p4;
            if ($differenz <= 0) {
              if ($lieferzeit < 4) {
                if ($lieferzeit <= 3 || $verbleibendeLieferzeit != 0) {
                  array_push($bestellungen, array(0, "N"));
                } else {
                  array_push($bestellungen, array($teil->diskontmenge, "N"));
                }
              } elseif (($teil->lieferzeit / 2) < $verbleibendeLieferzeit && $verbleibendeLieferzeit != 0) {
                array_push($bestellungen, array($teil->diskontmenge, "E"));
              } elseif ($verbleibendeLieferzeit == 0) {
                array_push($bestellungen, array($teil->diskontmenge, "E"));
              } else {
                array_push($bestellungen, array(0, "N"));
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

  function berechnungBestelleingaenge($eB, $kaufteile, $aktuellePeriode)
  {
    $b = [];

    foreach ($eB as $bestellung) {
      $teilenummer = $bestellung[2];
      $eingangsPeriode = $aktuellePeriode - $bestellung[0];
      foreach ($kaufteile as $teil) {
        if ($teilenummer == $teil->nummer) {
          if ($bestellung[1] == "4") {
            $lieferzeit = $teil->lieferzeit / 2;
          } else {
            $lieferzeit = $teil->lieferzeit + $teil->abweichung;
          }

          $verbleibendeLieferzeit = $lieferzeit - $eingangsPeriode;
        }
      }

      array_push($b, array($teilenummer, $verbleibendeLieferzeit, $bestellung[3]));
    }

    return $b;
  }
}
