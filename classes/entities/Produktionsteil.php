<?php
class Produktionsteil extends Teil
{
    public bool $dreifach;
    public int $sicherheitsbestand;

    /*function __construct($nummer, $anzahl, $preis, $dreifach, $sicherheitsbestand) {
       parent::__construct($nummer, $anzahl, $preis);
       $this->dreifach = $dreifach;
       $this->sicherheitsbestand = $sicherheitsbestand;
      }*/
}