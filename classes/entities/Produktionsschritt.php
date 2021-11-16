<?php
class Produktionsschritt
{
  public Arbeitsplatz $arbeitsplatz;
  public Produktionsteil $produktionsteil;
  public Produktionsschritt $vorgaenger;
  public Produktionsschritt $nachgaenger;
  public int $bearbeitungszeit;
}
