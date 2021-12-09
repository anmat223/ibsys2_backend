<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/entities/Bestellung.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Periode.php');
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

    $bruttobedarfPeriode = $kaufteil->p1 * $produktionsprogramm['p1'];
    $bruttobedarfPeriode += $kaufteil->p2 * $produktionsprogramm['p2'];
    $bruttobedarfPeriode += $kaufteil->p3 * $produktionsprogramm['p3'];

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

  function berechnungBestellung($kaufteile){
    foreach($kaufteile as $teil){
    // Variablen befüllen
      $bestellungen = [];
      $lieferzeit = $teil->lieferzeit + $teil->abweichung;

      $produktionsprogrammP1 = $_SESSION['produktionsprogrammMitPrognosen'][0];
      $p1 =  $teil->p1 * $produktionsprogrammP1[0] + $teil->p2 * $produktionsprogrammP1[1] + $teil->p3 * $produktionsprogrammP1[2]; 
      
      $produktionsprogrammP2 = $_SESSION['produktionsprogrammMitPrognosen'][1];
      $p2= $teil->p1 * $produktionsprogrammP2[0] + $teil->p2 * $produktionsprogrammP2[1] + $teil->p3 * $produktionsprogrammP2[2]; 
            
      $produktionsprogrammP3 = $_SESSION['produktionsprogrammMitPrognosen'][2];
      $p3= $teil->p1 * $produktionsprogrammP3[0] + $teil->p2 * $produktionsprogrammP3[1] + $teil->p3 * $produktionsprogrammP3[2]; 
              
      $produktionsprogrammP4 = $_SESSION['produktionsprogrammMitPrognosen'][3];
      $p4= $teil->p1 * $produktionsprogrammP4[0] + $teil->p2 * $produktionsprogrammP4[1] + $teil->p3 * $produktionsprogrammP4[2]; 

    //Berechnung
      $differenz= $teil->anzahl - $p1;
      if($differenz <= 0){
        if($lieferzeit < 1){
          array_push($bestellungen,array($teil->diskontmenge, "Normal"));
        }else{
          array_push($bestellungen, array($teil->diskontmenge, "Eil"));
        }
      }else{
        $differenz = $teil->anzahl - $p2;
        if($differenz <= 0){
          if($lieferzeit < 2){
            if($lieferzeit <= 1){
              array_push($bestellung,array(0,"Normal"));
            }else{array_push($bestellungen,array($teil->diskontmenge, "Normal"));}
          }else{
            array_push($bestellungen, array($teil->diskontmenge, "Eil"));
          }
        }else{
          $differenz = $teil->anzahl - $p3;
          if($differenz <= 0){
            if($lieferzeit <= 3){
              if($lieferzeit <= 2){
                array_push($bestellung,array(0,"Normal"));
              }else{array_push($bestellungen,array($teil->diskontmenge, "Normal"));}
            }else{
              array_push($bestellungen, array($teil->diskontmenge, "Eil"));
            }
          }else{
            $differenz = $teil->anzahl - $p4;
            if($differenz <= 0){
              if($lieferzeit <= 4){
                if($lieferzeit <= 3){
                  array_push($bestellung,array(0,"Normal"));
                }else{array_push($bestellungen,array($teil->diskontmenge, "Normal"));}
              }else{
                array_push($bestellungen, array($teil->diskontmenge, "Eil"));
              }
            }else{
              array_push($bestellung,array(0,"Normal"));
            }
          }
        }
      }
    }
    return $bestellungen;
  }
}