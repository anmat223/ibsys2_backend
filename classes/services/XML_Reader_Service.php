<?php
require_once('./classes/entities/Teil.php');
require_once('./classes/entities/Produktionsteil.php');
require_once('./classes/entities/Kaufteil.php');
// für file upload: https://www.w3schools.com/php/php_file_upload.asp

class XML_Reader_Service
{

  public $xmldata;
  public $xmlFilePath;

  function get_forecast()
  {
    $xmldata = simplexml_load_file("resources/data.xml") or die("Failed to load");
    $forecasts = [];
    $p1 = $xmldata->forecast['p1'];
    $p2 = $xmldata->forecast['p2'];
    $p3 = $xmldata->forecast['p3'];
    array_push($forecasts, $p1, $p2, $p3);
    return $forecasts;
  }

  function get_warehousestock() // return List<Teil> (Produktions oder Kaufteil)
  {
    $xmldata = simplexml_load_file("resources/daten.xml") or die("Failed to load");
    $produktionsteile = [];
    $kaufteile = [];
    foreach ($xmldata->warehousestock->article as $articl) {

      $id = $articl['id'];      
      $anzahl = $articl['amount'];
      $preis = $articl['price'];
      if ($id >= 4 && $id <= 20) {        
        //preis als double        
        array_push($produktionsteile, new Produktionsteil(intval($id), intval($anzahl), intval($preis)));
      } else if ($id >= 21 && $id <= 25) {        
        array_push($kaufteile, new Kaufteil(intval($id), intval($anzahl), intval($preis)));
      } else if ($id == 26 || $id >= 29 && $id <= 31) {
        array_push($produktionsteile, new Produktionsteil(intval($id), intval($anzahl), intval($preis)));
      } else if ($id == 27 || $id == 28 || $id == 52 || $id == 53) {
        array_push($kaufteile, new Kaufteil(intval($id), intval($anzahl), intval($preis)));
      } else if ($id >= 32 && $id <= 48) {
        array_push($kaufteile, new Kaufteil(intval($id), intval($anzahl), intval($preis)));
      } else if ($id >= 49 && $id <= 51) {
        array_push($produktionsteile, new Produktionsteil(intval($id), intval($anzahl), intval($preis)));
      } else if ($id >= 54 && $id <= 56) {
        array_push($produktionsteile, new Produktionsteil(intval($id), intval($anzahl), intval($preis)));
      } else if ($id >= 57 && $id <= 59) {
        array_push($kaufteile, new Kaufteil(intval($id), intval($anzahl), intval($preis)));
      }
    }    
    return array($produktionsteile, $kaufteile); // 2 Arrays machen array(array(Kaufteile) und array(Eigenproduktionsteile))
    // entity Teil 
    // evtl logik -> if id <x Kauf oder Produktionsteil
  }

  function get_inwardstockmovement()
  {
    $xmldata = simplexml_load_file("resources/daten.xml") or die("Failed to load");
    echo "Lagereingänge: " . "<br>";
    foreach ($xmldata->inwardstockmovement->order as $order) {
      echo "Bestellid: " . $order['id'] . " ";
      echo "Bestellmodus: " . $order['mode'] . " ";
      echo "Artikel: " . $order['article'] . " ";
      echo "Anzahl: " . $order['amount'] . " ";
      echo "Zeit: " . $order['time'] . " ";
      echo "Materialkosten: " . $order['materialcosts'] . " ";
      echo "Bestellkosten: " . $order['ordercosts'] . "<br>";
    }
  }

  function get_futureinwardstockmovement()
  {
    $xmldata = simplexml_load_file("resources/daten.xml") or die("Failed to load");
    echo "zukünftige Lagereingänge: " . "<br>";
    foreach ($xmldata->futureinwardstockmovement->order as $order) {
      echo "Bestellid: " . $order['id'] . " ";
      echo "Bestellperiode: " . $order['orderperiod'] . " ";
      echo "Bestellmodus: " . $order['mode'] . " ";
      echo "Artikel: " . $order['article'] . " ";
      echo "Anzahl: " . $order['amount'] . "<br>";
    }
  }

  function get_idletimecosts()
  {
    $xmldata = simplexml_load_file("resources/daten.xml") or die("Failed to load");
    echo "Leerkosten: " . "<br>";
    foreach ($xmldata->idletimecosts->workplace as $workplace) {

      echo "Arbeitsplatz: " . $workplace['id'] . " ";
      echo "setupevents: " . $workplace['setupevents'] . " ";
      echo "Leerzeit: " . $workplace['idletime'] . " ";
      echo "wageidletimecosts: " . $workplace['wageidletimecosts'] . " ";
      echo "wagecosts: " . $workplace['wagecosts'] . " ";
      echo "Maschinenleerzeitkosten: " . $workplace['machineidletimecosts'] . "<br>";
    }
  }

  function get_waitinglistworkstations()
  {
    $xmldata = simplexml_load_file("resources/daten.xml") or die("Failed to load");
    $waitinglistworkstations = [];
    foreach ($xmldata->waitinglistworkstations->workplace as $workplace) {

      if ($workplace['timeneed'] != 0) {
        $workplaceid = $workplace['id'];
        $timeneed = $workplace['timeneed'];

        foreach ($workplace->waitinglist as $waitinglist) {
          $order = $waitinglist['order'];
          $firstbatch = $waitinglist['firstbatch'];
          $lastbatch = $waitinglist['lastbatch'];
          $item = $waitinglist['item'];
          $amount = $waitinglist['amount'];
          $timeneed = $waitinglist['timeneed'];

          array_push($waitinglistworkstations, new WartendeArtikel(new Teil($item, $amount, null), new Arbeitsplatz($workplaceid, null), false, $amount, $timeneed));
        }
      }
    }
    return $waitinglistworkstations;
    // entity wartende artickel //für vincent
  }

  function get_waitingliststock() // return Warteliste Material
  {
    $xmldata = simplexml_load_file("resources/daten.xml") or die("Failed to load");
    $waitingliststock = [];
    foreach ($xmldata->waitingliststock->missingpart as $missingpart) {
      if ($missingpart->workplace) {
        foreach ($missingpart->workplace as $workplace) {
          $workplaceid = $workplace['id'];
          $timeneed = $workplace['timeneed'];

          foreach ($workplace->waitinglist as $waitinglist) {
            $order = $waitinglist['order'];
            $firstbatch = $waitinglist['firstbatch'];
            $lastbatch = $waitinglist['lastbatch'];
            $item = $waitinglist['item'];
            $amount = $waitinglist['amount'];
            $timeneed = $waitinglist['timeNeed'];

            array_push($waitingliststock, new WartendeArtikel(new Teil($item, $amount, null), new Arbeitsplatz($workplaceid, null), false, $amount, $timeneed));
          }
        }
      }
    }
    return $waitingliststock;
    // wartende artikel vincent
  }

  function get_ordersinwork()
  {
    $xmldata = simplexml_load_file("resources/daten.xml") or die("Failed to load");
    $ordersinwork = [];
    foreach ($xmldata->ordersinwork->workplace as $workplace) {
      $workplaceid = $workplace['id'];
      $order = $workplace['order'];
      $batch = $workplace['batch'];
      $item = $workplace['item'];
      $amount = $workplace['amount'];
      $timeneed = $workplace['timeneed'];

      array_push($ordersinwork, new WartendeArtikel(new Teil($item, $amount, null), new Arbeitsplatz($workplaceid, null), true, $amount, $timeneed));
      // ToDo: Ruestzeit pro Arbeitsplatz einpflegen bzw. klären an welcher Stelle das und andere Infos z.B. Sicherheitsbestand aus DB gelesen werden
    }
    return $ordersinwork;
  }
  // wartende artikel für vincent
}
