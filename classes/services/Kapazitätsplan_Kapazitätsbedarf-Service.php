<?php

class KapazitätsbedarfNeuService{

    function berechnungKapazitätsbedarfNeu($auftragsmenge) {

        // initaliserung Array

        $kapabedarfArbeitsplatz = array();
        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 1
        $kapazitätsbedarfA1 = 6 * $auftragsmenge[49];
        $kapazitätsbedarfA1 += 6 * $auftragsmenge[54];
        $kapazitätsbedarfA1 += 6 * $auftragsmenge[29];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA1);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 2
        $kapazitätsbedarfA2 = 5 * $auftragsmenge[50];
        $kapazitätsbedarfA2 += 5 * $auftragsmenge[55];
        $kapazitätsbedarfA2 += 5 * $auftragsmenge[30];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA2);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 3
        $kapazitätsbedarfA3 = 5 * $auftragsmenge[51];
        $kapazitätsbedarfA3 += 6 * $auftragsmenge[56];
        $kapazitätsbedarfA3 += 6 * $auftragsmenge[31];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA3);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 4
        $kapazitätsbedarfA4 = 6 * $auftragsmenge[1];
        $kapazitätsbedarfA4 += 7 * $auftragsmenge[2];
        $kapazitätsbedarfA4 += 7 * $auftragsmenge[3];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA4);

        // Arbeitsplatz 5
        array_push($kapabedarfArbeitsplatz, 0);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 6
        $kapazitätsbedarfA6 = 2 * $auftragsmenge[16];
        $kapazitätsbedarfA6 += 3 * $auftragsmenge[18];
        $kapazitätsbedarfA6 += 3 * $auftragsmenge[19];
        $kapazitätsbedarfA6 += 3 * $auftragsmenge[20];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA6);

        // berechnung Kapazitätsbedarf(neu) für Arbeitsplatz 7
        $kapazitätsbedarfA7 = 2 * $auftragsmenge[10];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[11];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[12];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[13];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[14];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[15];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[18];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[19];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[20];
        $kapazitätsbedarfA7 += 2 * $auftragsmenge[26];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA7);

        //berechnung Kapatitäsbedarf(neu) für Arbeitsplatz 8
        $kapazitätsbedarfA8 = 1 * $auftragsmenge[10];
        $kapazitätsbedarfA8 += 2 * $auftragsmenge[11];
        $kapazitätsbedarfA8 += 2 * $auftragsmenge[12];
        $kapazitätsbedarfA8 += 1 * $auftragsmenge[13];
        $kapazitätsbedarfA8 += 2 * $auftragsmenge[14];
        $kapazitätsbedarfA8 += 2 * $auftragsmenge[15];
        $kapazitätsbedarfA8 += 3 * $auftragsmenge[18];
        $kapazitätsbedarfA8 += 3 * $auftragsmenge[19];
        $kapazitätsbedarfA8 += 3 * $auftragsmenge[20];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA8);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 9
        $kapazitätsbedarfA9 = 3 * $auftragsmenge[10];
        $kapazitätsbedarfA9 += 3 * $auftragsmenge[11];
        $kapazitätsbedarfA9 += 3 * $auftragsmenge[12];
        $kapazitätsbedarfA9 += 3 * $auftragsmenge[13];
        $kapazitätsbedarfA9 += 3 * $auftragsmenge[14];
        $kapazitätsbedarfA9 += 3 * $auftragsmenge[15];
        $kapazitätsbedarfA9 += 2 * $auftragsmenge[18];
        $kapazitätsbedarfA9 += 2 * $auftragsmenge[19];
        $kapazitätsbedarfA9 += 2 * $auftragsmenge[20];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA9);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 10
        $kapazitätsbedarfA10 = 4 * $auftragsmenge[4];
        $kapazitätsbedarfA10 += 4 * $auftragsmenge[5];
        $kapazitätsbedarfA10 += 4 * $auftragsmenge[6];
        $kapazitätsbedarfA10 += 4 * $auftragsmenge[7];
        $kapazitätsbedarfA10 += 4 * $auftragsmenge[8];
        $kapazitätsbedarfA10 += 4 * $auftragsmenge[9];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA10);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 11
        $kapazitätsbedarfA11 = 3 * $auftragsmenge[4];
        $kapazitätsbedarfA11 += 3 * $auftragsmenge[5];
        $kapazitätsbedarfA11 += 3 * $auftragsmenge[6];
        $kapazitätsbedarfA11 += 3 * $auftragsmenge[7];
        $kapazitätsbedarfA11 += 3 * $auftragsmenge[8];
        $kapazitätsbedarfA11 += 3 * $auftragsmenge[9];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA11);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 12
        $kapazitätsbedarfA12 = 3 * $auftragsmenge[10];
        $kapazitätsbedarfA12 += 3 * $auftragsmenge[11];
        $kapazitätsbedarfA12 += 3 * $auftragsmenge[12];
        $kapazitätsbedarfA12 += 3 * $auftragsmenge[13];
        $kapazitätsbedarfA12 += 3 * $auftragsmenge[14];
        $kapazitätsbedarfA12 += 3 * $auftragsmenge[15];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA12);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 13
        $kapazitätsbedarfA13 = 2 * $auftragsmenge[10];
        $kapazitätsbedarfA13 += 2 * $auftragsmenge[11];
        $kapazitätsbedarfA13 += 2 * $auftragsmenge[12];
        $kapazitätsbedarfA13 += 2 * $auftragsmenge[13];
        $kapazitätsbedarfA13 += 2 * $auftragsmenge[14];
        $kapazitätsbedarfA13 += 2 * $auftragsmenge[15];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA13);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 14
        $kapazitätsbedarfA14 = 3 * $auftragsmenge[16];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA14);

        //berechnung Kapazitätsbedarf(neu) Arbeitsplatz 15
        $kapazitätsbedarfA15 = 3 * $auftragsmenge[17];
        $kapazitätsbedarfA15 = 3 * $auftragsmenge[26];
        array_push($kapabedarfArbeitsplatz, $kapazitätsbedarfA15);

        return $kapabedarfArbeitsplatz;
    }

    function berechnungKapazitätsbedarfGesamt($kapaBedarfNeu, $rüstzeitNeu, $kapaBedarfRückstand, $rüstzeitRückstand){
        $kapaBedarfGesamt = array();
        for($i=0;$i < 15; ++$i){
            $kapaBedarfGesamt[$i] = $kapaBedarfNeu[$i] + $rüstzeitNeu[$i] + $kapaBedarfRückstand[$i] + $rüstzeitRückstand[$i];
        }
        return $kapaBedarfGesamt;
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
                            if($differenz <= 1200){
                                $überstunden[$i] = $differenz;
                            }else{
                                $überstunden[$i] = 1200;
                            }
                            $schichten[$i] = 3;
                        }
                    }
                }
            }
        }   
        return array($überstunden, $schichten);
    }
    
}