<?php 
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

$id = $_GET["id"];
$produktionsprogramm = $_SESSION['produktionsprogrammMitPrognosen'];

$kaufteileService = new DispositionKaufteileService();
for ($i = 0; $i < count($kaufteileDB); $i++) {
  for ($j = 0; $j < count($kaufteile); $j++) {
    if ($kaufteile[$j]->nummer == $kaufteileDB[$i]['teil']) {
      $kaufteile[$j]->lieferzeit = $kaufteileDB[$i]['lieferzeit'];
      $kaufteile[$j]->abweichung = $kaufteileDB[$i]['abweichung'];
      $kaufteile[$j]->diskontmenge = $kaufteileDB[$i]['diskontmenge'];
      $kaufteile[$j]->p1 = $kaufteileDB[$i]['p1'];
      $kaufteile[$j]->p2 = $kaufteileDB[$i]['p2'];
      $kaufteile[$j]->p3 = $kaufteileDB[$i]['p3'];
    }
  }
}

$eingehendeBestellungen = $readerService->get_futureinwardstockmovement();
$aktuellePeriode = $readerService->get_currentPeriod();
$bestelleingaenge = $kaufteileService->berechnungBestelleingaenge($eingehendeBestellungen, $kaufteile, $aktuellePeriode);

$bestellungen = $kaufteileService->berechnungBestellung($kaufteile, $bestelleingaenge);

$anzahl = 0;
$produkte = [0,0,0];
$lieferzeit = 0;
$abweichung = 0; 
for($i = 0; $i < count($kaufteile); $i++) {
    if($kaufteile[$i]->nummer == $id) {
        $anzahl = $kaufteile[$i]->anzahl;
        $produkte[0] = $kaufteile[$i]->p1;
        $produkte[1] = $kaufteile[$i]->p2;
        $produkte[2] = $kaufteile[$i]->p3;
        $lieferzeit = $kaufteile[$i]->lieferzeit;
        $abweichung = $kaufteile[$i]->abweichung;
    }
} 

$zeitbezogenerWert = [];
$zeitbezogenerWert[0] = $anzahl;
for($i = 0; $i < count($produktionsprogramm); $i++) {
    $zeitbezogenerWert[$i+1] = $zeitbezogenerWert[$i] - ($produkte[0] * $produktionsprogramm[$i][0] + $produkte[1] * $produktionsprogramm[$i][1] + $produkte[2] * $produktionsprogramm[$i][2]);
} 

$bestellMeta = [];
for($i = 0; $i < count($eingehendeBestellungen); $i++) {
    if($eingehendeBestellungen[$i][2] == $id) {
        $bestellMeta['bestellZeitpunkt'] = $eingehendeBestellungen[$i][0];
        $bestellMeta['bestellModus'] = $eingehendeBestellungen[$i][1];
        $bestellMeta['bestellMenge'] = $eingehendeBestellungen[$i][3];
    }
}

if (count($bestellMeta) != 0) {
    if($bestellMeta['bestellModus'] == 5) {
        $bestellMeta['lieferZeitpunkt'] = floor($bestellMeta['bestellZeitpunkt'] + $lieferzeit + $abweichung);
    } else {
        $bestellMeta['lieferZeitpunkt'] = floor($bestellMeta['bestellZeitpunkt'] + $lieferzeit/2);
    }
    $relevantePeriode = $bestellMeta['lieferZeitpunkt'] - $aktuellePeriode;
    for($i = $relevantePeriode + 1; $i < count($zeitbezogenerWert); $i++) {
        $zeitbezogenerWert[$i] += $bestellMeta['bestellMenge'];
    }
}

for ($i = 0; $i < count($zeitbezogenerWert); $i++) {
    if($zeitbezogenerWert[$i] < 0) $zeitbezogenerWert[$i] = 0;
}
?> 
<h2><?php if ($_SESSION['language'] == "DE") {
      echo "Entwicklung Lagerbestand Kaufteil ";
    } else {
      echo "Development of inventory purchase part ";
    }
    ?><?= $id ?></h2>
<div style="width: 40%">
  <canvas id="myChart"></canvas>
</div>

<button class="btn btn-dark"><a style="color: white" href="/ibsys2_backend/resources/views/kaufteilDisposition.php">Zurück</a></button>


<script>
    const labels = [
        'Periode 0',
        'Periode 1',
        'Periode 2',
        'Periode 3',
        'Periode 4',
    ];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Kaufteil <?php echo $id; ?>',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [<?= $zeitbezogenerWert[0] ?> , <?= $zeitbezogenerWert[1] ?>, <?= $zeitbezogenerWert[2] ?>, <?= $zeitbezogenerWert[3] ?>, <?= $zeitbezogenerWert[4] ?>],
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {}
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>