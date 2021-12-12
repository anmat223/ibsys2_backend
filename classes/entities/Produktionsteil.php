<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/classes/entities/Teil.php');
class Produktionsteil extends Teil
{
  public bool $dreifach;
  public int $sicherheitsbestand;
  public int $inWarteschlange;
  public int $inBearbeitung;
  public int $produktionsAuftrag;

  public function __construct($nummer, $anzahl, $preis, $dreifach = false, $sicherheitsbestand = 0)
  {
    parent::__construct($nummer, $anzahl, $preis);
    $this->dreifach = $dreifach;
    $this->sicherheitsbestand = $sicherheitsbestand;
  }
}
