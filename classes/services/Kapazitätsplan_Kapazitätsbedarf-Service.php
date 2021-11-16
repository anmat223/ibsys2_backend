<?php

class KapazitätsbedarfNeuService{

    function berechnungKapazitätsbedarfNeu($produktion) {

        // initaliserung Array

        $kapabedarfArbeitsplatz = array();
        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 1
        $kapazitätsbedarfA1 = 6 * $produktion->auftragsmenge[18];
        $kapazitätsbedarfA1 += 6 * $produktion->auftragsmenge[19];
        $kapazitätsbedarfA1 += 6 * $produktion->auftragsmenge[20];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA1);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 2
        $kapazitätsbedarfA2 = 5 * $produktion->auftragsmenge[21];
        $kapazitätsbedarfA2 += 5 * $produktion->auftragsmenge[22];
        $kapazitätsbedarfA2 += 5 * $produktion->auftragsmenge[23];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA2);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 3
        $kapazitätsbedarfA3 = 5 * $produktion->auftragsmenge[24];
        $kapazitätsbedarfA3 += 6 * $produktion->auftragsmenge[25];
        $kapazitätsbedarfA3 += 6 * $produktion->auftragsmenge[26];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA3);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 4
        $kapazitätsbedarfA4 = 6 * $produktion->auftragsmenge[27];
        $kapazitätsbedarfA4 += 7 * $produktion->auftragsmenge[28];
        $kapazitätsbedarfA4 += 7 * $produktion->auftragsmenge[29];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA4);

        // Arbeitsplatz 5
        array_push($kapabedarfArbeitsplatz, 0);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 6
        $kapazitätsbedarfA6 = 2 * $produktion->auftragsmenge[12];
        $kapazitätsbedarfA6 += 3 * $produktion->auftragsmenge[14];
        $kapazitätsbedarfA6 += 3 * $produktion->auftragsmenge[15];
        $kapazitätsbedarfA6 += 3 * $produktion->auftragsmenge[16];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA6);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 7
        $kapazitätsbedarfA7 = 2 * $produktion->auftragsmenge[6];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[7];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[8];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[9];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[10];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[11];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[14];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[15];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[16];
        $kapazitätsbedarfA7 += 2 * $produktion->auftragsmenge[17];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA7);

        //berechnung Kapatitäsbedarf(neu) für Arbeitsplatz 8
        $kapazitätsbedarfA8 = 1 * $produktion->auftragsmenge[6];
        $kapazitätsbedarfA8 += 2 * $produktion->auftragsmenge[7];
        $kapazitätsbedarfA8 += 2 * $produktion->auftragsmenge[8];
        $kapazitätsbedarfA8 += 1 * $produktion->auftragsmenge[9];
        $kapazitätsbedarfA8 += 2 * $produktion->auftragsmenge[10];
        $kapazitätsbedarfA8 += 2 * $produktion->auftragsmenge[11];
        $kapazitätsbedarfA8 += 3 * $produktion->auftragsmenge[14];
        $kapazitätsbedarfA8 += 3 * $produktion->auftragsmenge[15];
        $kapazitätsbedarfA8 += 3 * $produktion->auftragsmenge[16];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA8);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 9
        $kapazitätsbedarfA9 = 3 * $produktion->auftragsmenge[6];
        $kapazitätsbedarfA9 += 3 * $produktion->auftragsmenge[7];
        $kapazitätsbedarfA9 += 3 * $produktion->auftragsmenge[8];
        $kapazitätsbedarfA9 += 3 * $produktion->auftragsmenge[9];
        $kapazitätsbedarfA9 += 3 * $produktion->auftragsmenge[10];
        $kapazitätsbedarfA9 += 3 * $produktion->auftragsmenge[11];
        $kapazitätsbedarfA9 += 2 * $produktion->auftragsmenge[14];
        $kapazitätsbedarfA9 += 2 * $produktion->auftragsmenge[15];
        $kapazitätsbedarfA9 += 2 * $produktion->auftragsmenge[16];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA9);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 10
        $kapazitätsbedarfA10 = 4 * $produktion->auftragsmenge[0];
        $kapazitätsbedarfA10 += 4 * $produktion->auftragsmenge[1];
        $kapazitätsbedarfA10 += 4 * $produktion->auftragsmenge[2];
        $kapazitätsbedarfA10 += 4 * $produktion->auftragsmenge[3];
        $kapazitätsbedarfA10 += 4 * $produktion->auftragsmenge[4];
        $kapazitätsbedarfA10 += 4 * $produktion->auftragsmenge[5];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA10);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 11
        $kapazitätsbedarfA11 = 3 * $produktion->auftragsmenge[0];
        $kapazitätsbedarfA11 += 3 * $produktion->auftragsmenge[1];
        $kapazitätsbedarfA11 += 3 * $produktion->auftragsmenge[2];
        $kapazitätsbedarfA11 += 3 * $produktion->auftragsmenge[3];
        $kapazitätsbedarfA11 += 3 * $produktion->auftragsmenge[4];
        $kapazitätsbedarfA11 += 3 * $produktion->auftragsmenge[5];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA11);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 12
        $kapazitätsbedarfA12 = 3 * $produktion->auftragsmenge[6];
        $kapazitätsbedarfA12 += 3 * $produktion->auftragsmenge[7];
        $kapazitätsbedarfA12 += 3 * $produktion->auftragsmenge[8];
        $kapazitätsbedarfA12 += 3 * $produktion->auftragsmenge[9];
        $kapazitätsbedarfA12 += 3 * $produktion->auftragsmenge[10];
        $kapazitätsbedarfA12 += 3 * $produktion->auftragsmenge[11];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA12);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 13
        $kapazitätsbedarfA13 = 2 * $produktion->auftragsmenge[6];
        $kapazitätsbedarfA13 += 2 * $produktion->auftragsmenge[7];
        $kapazitätsbedarfA13 += 2 * $produktion->auftragsmenge[8];
        $kapazitätsbedarfA13 += 2 * $produktion->auftragsmenge[9];
        $kapazitätsbedarfA13 += 2 * $produktion->auftragsmenge[10];
        $kapazitätsbedarfA13 += 2 * $produktion->auftragsmenge[11];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA13);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 14
        $kapazitätsbedarfA14 = 3 * $produktion->auftragsmenge[12];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA14);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 15
        $kapazitätsbedarfA15 = 3 * $produktion->auftragsmenge[13];
        $kapazitätsbedarfA15 = 3 * $produktion->auftragsmenge[17];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA15);

        return $kapabedarfArbeitsplatz;
    }

    function berechnungKapazitätsbedarfGesamt($arbeitsplatz, $wartendeArtikel){
  
    }
    
    function berechnungSchichtenÜberstunden($gesamtBedarf){
        $überstunden = array();
        $schichten = array();

        for($i=0;$i < count($gesamtBedarf);++$i){
            if($gesamtBedarf[$i] <= 2400){
                $überstunden[$i] = 0;
                $schichten[$i] = 0;
            }else{
               $differenz = $gesamtBedarf[$i] - 2400;
                if($differenz <= 1200){
                    $überstunden[$i] = $differenz;
                    $schichten[$i] = 0;
                }else{
                    $differenz = $gesamtBedarf[$i] - 4800;
                    if($differenz <= 1200){
                        $überstunden[$i] = $differenz;
                        $schichten[$i] = 1;
                    }else{
                        $differenz = $gesamtBedarf[$i] - 7200;
                        if($differenz <= 1200){
                            $überstunden[$i] = $differenz;
                            $schichten[$i] = 2;
                        }else{
                            $differenz = $gesamtBedarf[$i] - 9600;
                            $überstunden[$i] = $differenz;
                            $schichten[$i] = 3;
                            // TODO:Error-handling  bei $differenz > 1200 ergänzen
                        }
                    }
                }
            }
        }   
        return array($überstunden, $schichten);
    }
    
}