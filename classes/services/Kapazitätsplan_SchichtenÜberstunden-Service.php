<?php
class SchichtenÜberstunden{
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