<?php
//require_once('./Teil.php');
class Produktionsteil extends Teil
{
    public bool $dreifach;
    public int $sicherheitsbestand;

    public function __construct($nummer, $anzahl, $preis)
    {
        parent::__construct($nummer, $anzahl, $preis);
    }
}
