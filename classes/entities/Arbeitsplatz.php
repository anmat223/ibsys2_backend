<?php
class Arbeitsplatz
{
  public int $nummer;
  public int $ruestzeit;

  public function __construct($nummer, $ruestzeit)
  {
    $this->nummer = $nummer;
    $this->ruestzeit = $ruestzeit; 
  }
}
