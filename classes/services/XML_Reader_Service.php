<?php

class XML_Reader_Service
{

  public $xmldata;  

  function get_warehousestock()
  {
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
    echo "Lager: " . "<br>";
    foreach ($xmldata->warehousestock->article as $articl) {

      echo "Artikelid: " . $articl['id'] . " ";
      echo "Anzahl: " . $articl['amount'] . " ";
      echo "Preis: " . $articl['price'] . "<br>";
    }
    // entity Teil
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
    foreach ($xmldata->waitinglistworkstations->workplace as $workplace) {

      if ($workplace['timeneed'] != 0) {
        echo "Arbeitsplatz: " . $workplace['id'] . " ";
        echo "Zeitbedarf: " . $workplace['timeneed'] . " ";

        foreach ($workplace->waitinglist as $waitinglist) {
          echo "Fertigungsauftrag: " . $waitinglist['order'] . " ";
          echo "Los: " . $waitinglist['firstbatch'] . "-" . $waitinglist['lastbatch'] . " ";
          echo "Teil: " . $waitinglist['item'] . " ";
          echo "Menge: " . $waitinglist['amount'] . " ";
          echo "Zeitbedarf: " . $waitinglist['timeneed'] . "<br>";
        }
      }
    }
    // entity wartende artickel
  }

  function get_waitingliststock()
  {
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
    echo "Warteliste Material: " . "<br>";
    foreach ($xmldata->waitingliststock->missingpart as $missingpart) {
      if ($missingpart->workplace) {
        foreach ($missingpart->workplace as $workplace) {
          echo "Arbeitsplatz: " . $workplace['id'] . " ";
          echo "Zeitbedarf: " . $workplace['timeneed'] . " ";

          foreach ($workplace->waitinglist as $waitinglist) {
            echo "Fertigungsauftrag: " . $waitinglist['order'] . " ";
            echo "Los: " . $waitinglist['firstbatch'] . "-" . $waitinglist['lastbatch'] . " ";
            echo "Teil: " . $waitinglist['item'] . " ";
            echo "Menge: " . $waitinglist['amount'] . " ";
            echo "Zeitbedarf: " . $waitinglist['timeNeed'] . "<br>";
          }
        }
      }
    }
    // wartende artikel
  }

  function get_ordersinwork()
  {
    $xmldata = simplexml_load_file("..\resources\daten.xml") or die("Failed to load");
    echo "Aufträge in Bearbeitung: " . "<br>";
    foreach ($xmldata->ordersinwork->workplace as $workplace) {
      echo "Arbeitsplatz: " . $workplace['id'] . " ";
      echo "Fertigungsauftrag: " . $workplace['order'] . " ";
      echo "Los: " . $workplace['batch'] . " ";
      echo "Teil: " . $workplace['item'] . " ";
      echo "Menge: " . $workplace['amount'] . " ";
      echo "Zeitbedarf: " . $workplace['timeneed'] . "<br>";
    }
  }
  // wartende artikel
}
