<?php
class Teil
{
    public int $nummer;
    public int $anzahl;
    public int $preis; //in cent, macht es leichter

    function __construct($nummer, $anzahl, $preis)
    {
        $this->nummer = $nummer;
        $this->anzahl = $anzahl;
        $this->preis = $preis;
    }
}
