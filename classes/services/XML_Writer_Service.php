<?php

class XML_Writer_Service
{
    public $xmlOutput;

    function write_output_to_xml()
    {
        $xmlOutput = new SimpleXMLElement('<?xml version="1.0"?><input/>');

        $qualitycontrol = $xmlOutput->addChild("qualitycontrol");
        $qualitycontrol->addAttribute("delay", "Wert für Verspätung");
        $qualitycontrol->addAttribute("losequantity", "Wert für losequantity");
        $qualitycontrol->addAttribute("type", "Wert für type");

        $sellwish = $xmlOutput->addChild("sellwish");
        // wie kriege ich die Verkaufswünsche? als array???
        foreach ($sellwishes as $sellwish) {
            $item = $sellwish->addChild("item");
            $item->addAttribute("quantity", "wert für quantity");
            $item->addAttribute("article", "article");
            // <item quantity="100" article="3"/>
        }

        $selldirect = $xmlOutput->addChild(("selldirect"));
        foreach ($selldirects as $selldirect) {
            $item = $selldirect->addChild("item");
            $item->addAttribute("quantity", "wert für quantity");
            $item->addAttribute("article", "article");
            $item->addAttribute("penalty", "strafe");
            $item->addAttribute("price", "Preis");
            // <item quantity="0" article="1" penalty="0.0" price="0.0"/>            
        }

        $orderlist = $xmlOutput->addChild("orderlist");
        foreach ($orders as $order) {
            $item = $orderlist->addChild("order");
            $item->addAttribute("quantity", "wert für quantity");
            $item->addAttribute("article", "article");
            $item->addAttribute("modus", "E oder N");
            // -<orderlist>
            // <order quantity="600" article="22" modus="5"/>
        }

        $productionlist = $xmlOutput->addChild("productionlist");
        foreach ($productions as $production) {
            $productionlistitem = $productionlist->addChild("production");
            $productionlistitem->addAttribute("quantity", "wert für quantity");
            $productionlistitem->addAttribute("article", "article");
            // <productionlist>
            // <production quantity="180" article="4"/>
        }

        $workingtimelist = $xmlOutput->addChild("workingtimelist");
        foreach ($productions as $production) {
            $workingtimeitem = $workingtimelist->addChild("workingtime");
            $workingtimeitem->addAttribute("overtime", "wert für Überstunden");
            $workingtimeitem->addAttribute("shift", "Schicht");
            $workingtimeitem->addAttribute("station", "arbeitsplatz");
            // <workingtimelist>
                // <workingtime overtime="0" shift="2" station="1"/>
        }

        file_put_contents('output.xml', $xmlOutput->asXML());
    }
}