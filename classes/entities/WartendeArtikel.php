<?php
class WartendeArtikel
{
  public Produktionsteil $produktionsteil;
  public Arbeitsplatz $arbeitsplatz;
  public bool $inBearbeitung;
  public int $anzahl;
  public int $bearbeitungszeit;

  function __construct($teil, $arbeitsplatz, $inBearbeitung, $anzahl, $bearbeitungszeit)
  {
    $this->produktionsteil = $teil;
    $this->arbeitsplatz = $arbeitsplatz;
    $this->inBearbeitung = $inBearbeitung;
    $this->anzahl = $anzahl;
    $this->bearbeitungszeit = $bearbeitungszeit;
  }
}
