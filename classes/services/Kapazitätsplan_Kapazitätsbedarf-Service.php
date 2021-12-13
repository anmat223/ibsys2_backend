<?php

class KapazitätsbedarfNeuService
{
  private $arbeitsarray = array(
    1 => array(
      49 => 20,
      54 => 20,
      29 => 20,
    ),
    2 => array(
      50 => 30,
      55 => 30,
      30 => 20,
    ),
    3 => array(
      51 => 20,
      56 => 20,
      31 => 20,
    ),
    4 => array(
      1 => 30,
      2 => 20,
      3 => 30,
    ),
    6 => array(
      16 => 15,
      18 => 15,
      19 => 15,
      20 => 15,
    ),
    7 => array(
      10 => 20,
      11 => 20,
      12 => 20,
      13 => 20,
      14 => 20,
      15 => 20,
      18 => 20,
      19 => 20,
      20 => 20,
      26 => 30,
    ),
    8 => array(
      10 => 15,
      11 => 15,
      12 => 15,
      13 => 15,
      14 => 15,
      15 => 15,
      18 => 20,
      19 => 25,
      20 => 20,
    ),
    9 => array(
      10 => 15,
      11 => 15,
      12 => 15,
      13 => 15,
      14 => 15,
      15 => 15,
      18 => 15,
      19 => 20,
      20 => 15,
    ),
    10 => array(
      4 => 20,
      5 => 20,
      6 => 20,
      7 => 20,
      8 => 20,
      9 => 20,
    ),
    11 => array(
      4 => 10,
      5 => 10,
      6 => 20,
      7 => 20,
      8 => 20,
      9 => 20,
    ),
    15 => array(
      17 => 15,
      26 => 15,
    ),
  );

  function berechnungKapazitätsbedarfNeu($auftragsmenge)
  {

    // initaliserung Array

    $kapabedarfArbeitsplatz = array();
    // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 1
    $kapazitätsbedarfA1 = 6 * $auftragsmenge[49][0];
    $kapazitätsbedarfA1 += 6 * $auftragsmenge[54][0];
    $kapazitätsbedarfA1 += 6 * $auftragsmenge[29][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA1);

    // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 2
    $kapazitätsbedarfA2 = 5 * $auftragsmenge[50][0];
    $kapazitätsbedarfA2 += 5 * $auftragsmenge[55][0];
    $kapazitätsbedarfA2 += 5 * $auftragsmenge[30][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA2);

    // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 3
    $kapazitätsbedarfA3 = 5 * $auftragsmenge[51][0];
    $kapazitätsbedarfA3 += 6 * $auftragsmenge[56][0];
    $kapazitätsbedarfA3 += 6 * $auftragsmenge[31][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA3);

    // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 4
    $kapazitätsbedarfA4 = 6 * $auftragsmenge[1][0];
    $kapazitätsbedarfA4 += 7 * $auftragsmenge[2][0];
    $kapazitätsbedarfA4 += 7 * $auftragsmenge[3][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA4);

    // Arbeitsplatz 5
    array_push($kapabedarfArbeitsplatz, 0);

    // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 6
    $kapazitätsbedarfA6 = 2 * $auftragsmenge[16][0];
    $kapazitätsbedarfA6 += 3 * $auftragsmenge[18][0];
    $kapazitätsbedarfA6 += 3 * $auftragsmenge[19][0];
    $kapazitätsbedarfA6 += 3 * $auftragsmenge[20][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA6);

    // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 7
    $kapazitätsbedarfA7 = 2 * $auftragsmenge[10][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[11][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[12][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[13][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[14][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[15][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[18][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[19][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[20][0];
    $kapazitätsbedarfA7 += 2 * $auftragsmenge[26][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA7);

    //berechnung Kapatitäsbedarf(neu) für Arbeitsplatz 8
    $kapazitätsbedarfA8 = 1 * $auftragsmenge[10][0];
    $kapazitätsbedarfA8 += 2 * $auftragsmenge[11][0];
    $kapazitätsbedarfA8 += 2 * $auftragsmenge[12][0];
    $kapazitätsbedarfA8 += 1 * $auftragsmenge[13][0];
    $kapazitätsbedarfA8 += 2 * $auftragsmenge[14][0];
    $kapazitätsbedarfA8 += 2 * $auftragsmenge[15][0];
    $kapazitätsbedarfA8 += 3 * $auftragsmenge[18][0];
    $kapazitätsbedarfA8 += 3 * $auftragsmenge[19][0];
    $kapazitätsbedarfA8 += 3 * $auftragsmenge[20][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA8);

    //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 9
    $kapazitätsbedarfA9 = 3 * $auftragsmenge[10][0];
    $kapazitätsbedarfA9 += 3 * $auftragsmenge[11][0];
    $kapazitätsbedarfA9 += 3 * $auftragsmenge[12][0];
    $kapazitätsbedarfA9 += 3 * $auftragsmenge[13][0];
    $kapazitätsbedarfA9 += 3 * $auftragsmenge[14][0];
    $kapazitätsbedarfA9 += 3 * $auftragsmenge[15][0];
    $kapazitätsbedarfA9 += 2 * $auftragsmenge[18][0];
    $kapazitätsbedarfA9 += 2 * $auftragsmenge[19][0];
    $kapazitätsbedarfA9 += 2 * $auftragsmenge[20][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA9);

    //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 10
    $kapazitätsbedarfA10 = 4 * $auftragsmenge[4][0];
    $kapazitätsbedarfA10 += 4 * $auftragsmenge[5][0];
    $kapazitätsbedarfA10 += 4 * $auftragsmenge[6][0];
    $kapazitätsbedarfA10 += 4 * $auftragsmenge[7][0];
    $kapazitätsbedarfA10 += 4 * $auftragsmenge[8][0];
    $kapazitätsbedarfA10 += 4 * $auftragsmenge[9][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA10);

    //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 11
    $kapazitätsbedarfA11 = 3 * $auftragsmenge[4][0];
    $kapazitätsbedarfA11 += 3 * $auftragsmenge[5][0];
    $kapazitätsbedarfA11 += 3 * $auftragsmenge[6][0];
    $kapazitätsbedarfA11 += 3 * $auftragsmenge[7][0];
    $kapazitätsbedarfA11 += 3 * $auftragsmenge[8][0];
    $kapazitätsbedarfA11 += 3 * $auftragsmenge[9][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA11);

    //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 12
    $kapazitätsbedarfA12 = 3 * $auftragsmenge[10][0];
    $kapazitätsbedarfA12 += 3 * $auftragsmenge[11][0];
    $kapazitätsbedarfA12 += 3 * $auftragsmenge[12][0];
    $kapazitätsbedarfA12 += 3 * $auftragsmenge[13][0];
    $kapazitätsbedarfA12 += 3 * $auftragsmenge[14][0];
    $kapazitätsbedarfA12 += 3 * $auftragsmenge[15][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA12);

    //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 13
    $kapazitätsbedarfA13 = 2 * $auftragsmenge[10][0];
    $kapazitätsbedarfA13 += 2 * $auftragsmenge[11][0];
    $kapazitätsbedarfA13 += 2 * $auftragsmenge[12][0];
    $kapazitätsbedarfA13 += 2 * $auftragsmenge[13][0];
    $kapazitätsbedarfA13 += 2 * $auftragsmenge[14][0];
    $kapazitätsbedarfA13 += 2 * $auftragsmenge[15][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA13);

    //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 14
    $kapazitätsbedarfA14 = 3 * $auftragsmenge[16][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA14);

    //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 15
    $kapazitätsbedarfA15 = 3 * $auftragsmenge[17][0];
    $kapazitätsbedarfA15 += 3 * $auftragsmenge[26][0];
    array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA15);

    return $kapabedarfArbeitsplatz;
  }

  function berechnungKapazitätsbedarfGesamt($kapaBedarfNeu, $rüstzeitNeu, $kapaBedarfRückstand, $rüstzeitRückstand)
  {
    $kapaBedarfGesamt = array();
    for ($i = 0; $i < 15; $i++) {
      $kapaBedarfGesamt[$i] = $kapaBedarfNeu[$i] + $rüstzeitNeu[$i] + $kapaBedarfRückstand[$i] + $rüstzeitRückstand[$i];
    }
    return $kapaBedarfGesamt;
  }

  function berechnungSchichtenÜberstunden($gesamtBedarf)
  {
    $überstunden = array();
    $schichten = array();

    for ($i = 0; $i < count($gesamtBedarf); $i++) {
      if ($gesamtBedarf[$i] <= 2400) {
        $überstunden[$i] = 0;
        $schichten[$i] = 1;
      } else {
        $differenz = $gesamtBedarf[$i] - 2400;
        if ($differenz <= 1200) {
          $überstunden[$i] = $differenz / 5;
          $schichten[$i] = 1;
        } else {
          $differenz = $gesamtBedarf[$i] - 4800;
          if ($differenz <= 1200) {
            $überstunden[$i] = $differenz / 5;
            $schichten[$i] = 2;
          } else {
            $differenz = $gesamtBedarf[$i] - 7200;
            if ($differenz <= 1200) {
              $überstunden[$i] = $differenz / 5;
              $schichten[$i] = 3;
            } else {
              $überstunden[$i] = 1200 / 5;
              $schichten[$i] = 3;
            }
          }
        }
      }
      // Nur positive Werte
      if ($überstunden[$i] < 0) {
        $überstunden[$i] = 0;
      }
      // runden
      $überstunden[$i] = round($überstunden[$i], 0, PHP_ROUND_HALF_UP);
      // Arbeitsplatz 5 aussortieren
      if ($i == 4) {
        $schichten[$i] = 0;
      }
    }
    return array($überstunden, $schichten);
  }

  function berechnenRuestzeitAlt($waitinglist)
  {
    $ruestzeitAlt = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    for ($i = 0; $i < count($waitinglist); $i++) {

      $produktionsteil = $waitinglist[$i]->produktionsteil->nummer;
      $arbeitsplatz = $waitinglist[$i]->arbeitsplatz->nummer;

      if ($arbeitsplatz != 12 && $arbeitsplatz != 13 && $arbeitsplatz != 14) {
        $ruestzeitAlt[$arbeitsplatz - 1] += $this->arbeitsarray[$arbeitsplatz][$produktionsteil];
      }
    }
    return $ruestzeitAlt;
  }

  function berechnungRuestZeitNeu($produktionsteile)
  {
    $arbeitsarray = $this->arbeitsarray;
    $ruestzeiten = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    foreach ($produktionsteile as $key => $teil) {
      foreach ($arbeitsarray as $arbeitsplatznr => $arbeitsplatz) {
        foreach ($arbeitsplatz as $teilenummer => $ruestzeit) {
          if ($key == $teilenummer) {
            //print_r($ruestzeit . "<br>");
            $ruestzeiten[$arbeitsplatznr - 1] += $ruestzeit * $teil[1];
          }
        }
      }
    }

    return $ruestzeiten;
  }
}
