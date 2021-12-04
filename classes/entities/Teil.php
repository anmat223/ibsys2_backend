<?php
class Teil
{
  public int $nummer;
  public int $anzahl;
  public int $preis; //in cent, macht es leichter

  public function __construct($nummer, $anzahl, $preis)
  {
    $this->nummer = $nummer;

    if ($anzahl) {
      $this->anzahl = $anzahl;
    } else {
      $this->anzahl = 0;
    }

    $this->preis = $preis;
  }
}
