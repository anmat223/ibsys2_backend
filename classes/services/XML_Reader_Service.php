<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

require_once($documentRoot . '/ibsys2_backend/classes/entities/Teil.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Produktionsteil.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Kaufteil.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/WartendeArtikel.php');
require_once($documentRoot . '/ibsys2_backend/classes/entities/Arbeitsplatz.php');
// für file upload: https://www.w3schools.com/php/php_file_upload.asp

class XML_Reader_Service
{
  private $pathToFile;

  public function __construct($filename)
  {
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    $pathToFile = $documentRoot . '/ibsys2_backend/uploads/' . $filename;
    $this->pathToFile = $pathToFile;
  }

  function get_forecast()
  {
    $xmldata = simplexml_load_file($this->pathToFile) or die("Failed to load");
    $forecasts = [];
    $p1 = $xmldata->forecast['p1'];
    $p2 = $xmldata->forecast['p2'];
    $p3 = $xmldata->forecast['p3'];
    array_push($forecasts, $p1, $p2, $p3);
    return $forecasts;
  }

  function get_warehousestock() // return List<Teil> (Produktions oder Kaufteil)
  {
    $xmldata = simplexml_load_file($this->pathToFile) or die("Failed to load");
    $produktionsteile = [];
    $kaufteile = [];
    foreach ($xmldata->warehousestock->article as $articl) {

      $id = $articl['id'];
      $anzahl = $articl['amount'];
      $preis = $articl['price'];
      if ($id <= 20) {
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

  function get_futureinwardstockmovement()
  {
    $eingehendeBestellungen = [];
    $xmldata = simplexml_load_file($this->pathToFile) or die("Failed to load");
    foreach ($xmldata->futureinwardstockmovement->order as $order) {
      $periode = $order['orderperiod'];
      $modus = $order['mode'];
      $teilenr = $order['article'];
      $anzahl = $order['amount'];
      array_push($eingehendeBestellungen, array($periode, $modus, $teilenr, $anzahl));
    }

    return $eingehendeBestellungen;
  }

  function get_waitinglistworkstations()
  {
    $xmldata = simplexml_load_file($this->pathToFile) or die("Failed to load");
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

          array_push($waitinglistworkstations, new WartendeArtikel(new Produktionsteil(intval($item), intval($amount), 0), new Arbeitsplatz(intval($workplaceid), 0), false, intval($amount), intval($timeneed)));
        }
      }
    }
    return $waitinglistworkstations;
    // entity wartende artickel //für vincent
  }

  function get_waitingliststock() // return Warteliste Material
  {
    $xmldata = simplexml_load_file($this->pathToFile) or die("Failed to load");
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

            array_push($waitingliststock, new WartendeArtikel(new Produktionsteil(intval($item), intval($amount), 0), new Arbeitsplatz(intval($workplaceid), 0), false, intval($amount), intval($timeneed)));
          }
        }
      }
    }
    return $waitingliststock;
    // wartende artikel vincent
  }

  function get_ordersinwork()
  {
    $xmldata = simplexml_load_file($this->pathToFile) or die("Failed to load");
    $ordersinwork = [];
    foreach ($xmldata->ordersinwork->workplace as $workplace) {
      $workplaceid = $workplace['id'];
      $order = $workplace['order'];
      $batch = $workplace['batch'];
      $item = $workplace['item'];
      $amount = $workplace['amount'];
      $timeneed = $workplace['timeneed'];

      array_push($ordersinwork, new WartendeArtikel(new Produktionsteil(intval($item), intval($amount), 0), new Arbeitsplatz(intval($workplaceid), 0), true, intval($amount), intval($timeneed)));
      // ToDo: Ruestzeit pro Arbeitsplatz einpflegen bzw. klären an welcher Stelle das und andere Infos z.B. Sicherheitsbestand aus DB gelesen werden
    }
    return $ordersinwork;
  }

  function get_currentPeriod()
  {
    $xmldata = simplexml_load_file($this->pathToFile) or die("Failed to load");
    return $xmldata['period'] + 1;
  }
}
