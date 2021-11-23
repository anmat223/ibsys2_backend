<?php

// für file upload: https://www.w3schools.com/php/php_file_upload.asp

class XML_Reader_Service
{

  public $xmldata;

  function get_warehousestock() // return List<Teil> (Produktions oder Kaufteil)
  {
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
    $warehousestockList = [];
    echo "Lager: " . "<br>";
    foreach ($xmldata->warehousestock->article as $articl) {

      $id = $articl['id'];
      $anzahl = $articl['amount'];
      $preis = $articl['price'];
      if ($id >= 4 && $id <= 20) {
        array_push($warehousestockList, new Produktionsteil($id, $anzahl, $preis));
      } else if ($id >= 21 && $id <= 25) {
        array_push($warehousestockList, new Kaufteil($id, $anzahl, $preis));
      } else if ($id == 26 || $id >= 29 && $id <= 31) {
        array_push($warehousestockList, new Produktionsteil($id, $anzahl, $preis));
      } else if ($id == 27 || $id == 28 || $id == 52 || $id == 53) {
        array_push($warehousestockList, new Kaufteil($id, $anzahl, $preis));
      } else if ($id >= 32 && $id <= 48) {
        array_push($warehousestockList, new Kaufteil($id, $anzahl, $preis));
      } else if ($id >= 49 && $id <= 51) {
        array_push($warehousestockList, new Produktionsteil($id, $anzahl, $preis));
      } else if ($id >= 54 && $id <= 56) {
        array_push($warehousestockList, new Produktionsteil($id, $anzahl, $preis));
      } else if ($id >= 57 && $id <= 59) {
        array_push($warehousestockList, new Kaufteil($id, $anzahl, $preis));
      }
      return $warehousestockList;
    }
    // entity Teil 
    // evtl logik -> if id <x Kauf oder Produktionsteil
  }

  function get_inwardstockmovement()
  {
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
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
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
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
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
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
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
    echo "Warteliste Arbeitsplatz: " . "<br>";
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
    // entity wartende artickel
  }

  function get_waitingliststock() // return Warteliste Material
  {
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
    echo "Warteliste Material: " . "<br>";
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
    // wartende artikel
  }

  function get_ordersinwork()
  {
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
    $ordersinwork = [];
    echo "Aufträge in Bearbeitung: " . "<br>";
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
  // wartende artikel
}
