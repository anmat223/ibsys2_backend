<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/entities/Kaufteil.php');

class XML_Writer_Service
{
  public $xmlOutput;

  function write_output_to_xml($sellwishes, $selldirects, $orders, $productions, $workingtimes)
  {
    $xmlOutput = new SimpleXMLElement('<?xml version="1.0"?><input/>');

    $qualitycontrol = $xmlOutput->addChild("qualitycontrol");
    $qualitycontrol->addAttribute("type", "no");
    $qualitycontrol->addAttribute("losequantity", 0);
    $qualitycontrol->addAttribute("delay", 0);
    
    

    $sellwishlist = $xmlOutput->addChild("sellwish");
    // wie kriege ich die Verkaufswünsche? als array???
    foreach ($sellwishes as $index => $sellwish) {
      $item = $sellwishlist->addChild("item");
      $item->addAttribute("article", $index + 1); // oder als key 1 bzw. 2 bzw. 3 machen
      $item->addAttribute("quantity", $sellwish);
      
      // <item quantity="100" article="3"/>
    }

    $selldirectlist = $xmlOutput->addChild(("selldirect")); // eingabefelder für direktauftrag
    foreach ($selldirects as $index => $selldirect) {
      $item = $selldirectlist->addChild("item");
      $item->addAttribute("article", $index + 1);
      $item->addAttribute("quantity", $selldirect["amount"]);
      $item->addAttribute("price", $selldirect["price"]);
      $item->addAttribute("penalty", $selldirect["penalty"]);
      // <item quantity="0" article="1" penalty="0.0" price="0.0"/>            
    }

    $orderlist = $xmlOutput->addChild("orderlist");
    foreach ($orders as $order) {
      $item = $orderlist->addChild("order");
      $item->addAttribute("article", $order->nummer);
      $item->addAttribute("quantity", $order->anzahl);
      $item->addAttribute("modus", $order->eilBestellung ? "4" : "5");
      // -<orderlist>
      // <order quantity="600" article="22" modus="5"/>
    }

    $productionlist = $xmlOutput->addChild("productionlist");
    foreach ($productions as $productionitem => $quantity) {
      $productionlistitem = $productionlist->addChild("production");
      $productionlistitem->addAttribute("article", $productionitem);
      $productionlistitem->addAttribute("quantity", $quantity);
      // <productionlist>
      // <production quantity="180" article="4"/>
    }
    //print_r($workingtimes);
    $workingtimelist = $xmlOutput->addChild("workingtimelist");

    for($i=0;$i < 15;$i++){
      $workingtimeitem = $workingtimelist->addChild("workingtime");
      $workingtimeitem->addAttribute("station", $i + 1);
      $workingtimeitem->addAttribute("shift", $workingtimes[1][$i]);
      $workingtimeitem->addAttribute("overtime", $workingtimes[0][$i]);
    }

      // <workingtimelist>
      // <workingtime overtime="0" shift="2" station="1"/>

    file_put_contents('output.xml', $xmlOutput->asXML());
  }
}
