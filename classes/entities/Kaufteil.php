<?php
require_once($documentRoot . '/classes/entities/Teil.php');
class Kaufteil extends Teil
{
  public int $eingehendeBestellungen;
  public float $lieferzeit;
  public float $abweichung;
  public int $diskontmenge;
  public int $verwendungP1;
  public int $verwendungP2;
  public int $verwendungP3;
  public int $bestellMenge = 0;
  public bool $eilBestellung = false;

  public function __construct($nummer, $anzahl, $preis)
  {
    parent::__construct($nummer, $anzahl, $preis);
  }
}
