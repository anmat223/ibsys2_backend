<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');

$kapazitaetsbedarfService = new KapazitätsbedarfNeuService();

$ruekstand = array_merge($wartelisteArbeitsplatz, $inWarteschlange);
$kapazitaetsbedarfAlt = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
for ($i = 0; $i < count($ruekstand); $i++) {
  $kapazitaetsbedarfAlt[$ruekstand[$i]->arbeitsplatz->nummer - 1] += $ruekstand[$i]->bearbeitungszeit;
}
$ruestzeitAlt = $kapazitaetsbedarfService->berechnenRuestzeitAlt($ruekstand);
$kapazitaetsbedarfNeu = $kapazitaetsbedarfService->berechnungKapazitätsbedarfNeu($_SESSION['produktionsauftraege']);
$ruestzeitNeu = $kapazitaetsbedarfService->berechnungRuestZeitNeu($_SESSION['produktionsauftraege'])[0];
$infoRuestZeitNeu = $kapazitaetsbedarfService->berechnungRuestZeitNeu($_SESSION['produktionsauftraege'])[1];
$kapazitaetsbedarfGesamt = $kapazitaetsbedarfService->berechnungKapazitätsbedarfGesamt($kapazitaetsbedarfNeu, $ruestzeitNeu, $kapazitaetsbedarfAlt, $ruestzeitAlt);
$schichtenUeberstunden = $kapazitaetsbedarfService->berechnungSchichtenÜberstunden($kapazitaetsbedarfGesamt);
$_SESSION['schichtenUeberstunden'] = $schichtenUeberstunden;
$ueberstunden = $schichtenUeberstunden[0];
$schichten = $schichtenUeberstunden[1];
?>
<h2><?php
    if ($_SESSION['language'] == "DE") {
      echo "Kapazitätsplan";
    } else {
      echo "Capacity plan";
    }
    ?></h2>
<div>
  <?php
  // print_r( $ruestzeitNeu); Zur Ansicht des arrays
  ?>
  <form action="<?php echo 'sendKapazitaetsplan.php' ?>" method="post">
    <table class="table table-bordered table-responsive">
      <thead>
        <tr>
          <th scope="col" data-editable="true">Arbeitsplatz</th>
          <th scope="col">1</th>
          <th scope="col">2</th>
          <th scope="col">3</th>
          <th scope="col">4</th>
          <th scope="col">5</th>
          <th scope="col">6</th>
          <th scope="col">7</th>
          <th scope="col">8</th>
          <th scope="col">9</th>
          <th scope="col">10</th>
          <th scope="col">11</th>
          <th scope="col">12</th>
          <th scope="col">13</th>
          <th scope="col">14</th>
          <th scope="col">15</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Kapazitätsbedarf(neu)</th>
          <td> <?php echo $kapazitaetsbedarfNeu[0] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[1] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[2] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[3] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[4] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[5] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[6] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[7] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[8] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[9] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[10] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[11] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[12] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[13] ?> </td>
          <td> <?php echo $kapazitaetsbedarfNeu[14] ?> </td>
        </tr>
        <tr>
          <style>
            span {
              display: none;
            }
            i:hover ~ span {
              display: block;
            }
          </style>          
          <th scope="row">Rüstzeit(neu)</th>
          <td> <?php echo $ruestzeitNeu[0] ?> <i class="bi bi-info-circle-fill"></i>       
            <?php foreach ($infoRuestZeitNeu[0] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>                
        </td>
          <td> <?php echo $ruestzeitNeu[1] ?>  <i class="bi bi-info-circle-fill"></i>               
            <?php foreach ($infoRuestZeitNeu[1] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[2] ?>  <i class="bi bi-info-circle-fill"></i>               
            <?php foreach ($infoRuestZeitNeu[2] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[3] ?>  <i class="bi bi-info-circle-fill"></i>              
            <?php foreach ($infoRuestZeitNeu[3] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[4] ?>  <i class="bi bi-info-circle-fill"></i>              
            <?php foreach ($infoRuestZeitNeu[4] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[5] ?>  <i class="bi bi-info-circle-fill"></i>               
            <?php foreach ($infoRuestZeitNeu[5] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[6] ?>  <i class="bi bi-info-circle-fill"></i>              
            <?php foreach ($infoRuestZeitNeu[6] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[7] ?>  <i class="bi bi-info-circle-fill"></i>
          <?php foreach ($infoRuestZeitNeu[7] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[8] ?>  <i class="bi bi-info-circle-fill"></i>
          <?php foreach ($infoRuestZeitNeu[8] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[9] ?>  <i class="bi bi-info-circle-fill"></i>
          <?php foreach ($infoRuestZeitNeu[9] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[10] ?>  <i class="bi bi-info-circle-fill"></i>
          <?php foreach ($infoRuestZeitNeu[10] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[11] ?>  <i class="bi bi-info-circle-fill"></i>
          <?php foreach ($infoRuestZeitNeu[11] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?></td>
          <td> <?php echo $ruestzeitNeu[12] ?>  <i class="bi bi-info-circle-fill"></i>
          <?php foreach ($infoRuestZeitNeu[12] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[13] ?>  <i class="bi bi-info-circle-fill"></i>
          <?php foreach ($infoRuestZeitNeu[13] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
          <td> <?php echo $ruestzeitNeu[14] ?>  <i class="bi bi-info-circle-fill"></i>
          <?php foreach ($infoRuestZeitNeu[14] as $infoTeil) : ?>
              <span class=""><?php echo $infoTeil; ?></span>          
          <?php endforeach;?>
        </td>
        </tr>
        <tr>
          <th scope="row">Kap.bed.(Rückstand Vorperiode)</th>
          <td> <?php echo $kapazitaetsbedarfAlt[0]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[1]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[2]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[3]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[4]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[5]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[6]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[7]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[8]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[9]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[10]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[11]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[12]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[13]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfAlt[14]; ?> </td>
        </tr>
        <tr>
          <th scope="row">Rüstzeit(Rückstand Vorperiode)</th>
          <td> <?php echo $ruestzeitAlt[0]; ?> </td>
          <td> <?php echo $ruestzeitAlt[1]; ?> </td>
          <td> <?php echo $ruestzeitAlt[2]; ?> </td>
          <td> <?php echo $ruestzeitAlt[3]; ?> </td>
          <td> <?php echo $ruestzeitAlt[4]; ?> </td>
          <td> <?php echo $ruestzeitAlt[5]; ?> </td>
          <td> <?php echo $ruestzeitAlt[6]; ?> </td>
          <td> <?php echo $ruestzeitAlt[7]; ?> </td>
          <td> <?php echo $ruestzeitAlt[8]; ?> </td>
          <td> <?php echo $ruestzeitAlt[9]; ?> </td>
          <td> <?php echo $ruestzeitAlt[10]; ?> </td>
          <td> <?php echo $ruestzeitAlt[11]; ?> </td>
          <td> <?php echo $ruestzeitAlt[12]; ?> </td>
          <td> <?php echo $ruestzeitAlt[13]; ?> </td>
          <td> <?php echo $ruestzeitAlt[14]; ?> </td>
        </tr>
        <tr>
          <th scope="row">Gesamt-Kapazitätsbedarf</th>
          <td> <?php echo $kapazitaetsbedarfGesamt[0]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[1]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[2]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[3]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[4]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[5]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[6]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[7]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[8]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[9]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[10]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[11]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[12]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[13]; ?> </td>
          <td> <?php echo $kapazitaetsbedarfGesamt[14]; ?> </td>
        </tr>
        <tr>
          <th scope="row">Schichten</th>
          <td> <input type="number" name="S1" value="<?php echo $schichten[0]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S2" value="<?php echo $schichten[1]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S3" value="<?php echo $schichten[2]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S4" value="<?php echo $schichten[3]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <?php echo $schichten[4]; ?> </td>
          <td> <input type="number" name="S6" value="<?php echo $schichten[5]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S7" value="<?php echo $schichten[6]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S8" value="<?php echo $schichten[7]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S9" value="<?php echo $schichten[8]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S10" value="<?php echo $schichten[9]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S11" value="<?php echo $schichten[10]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S12" value="<?php echo $schichten[11]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S13" value="<?php echo $schichten[12]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S14" value="<?php echo $schichten[13]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
          <td> <input type="number" name="S15" value="<?php echo $schichten[14]; ?>" onchange="validateSchichten(this.value, this.name)" /> </td>
        </tr>
        <tr>
          <th scope="row">Überstunden pro Tag</th>
          <td> <input type="number" name="UE1" value="<?php echo $ueberstunden[0]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE2" value="<?php echo $ueberstunden[1]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE3" value="<?php echo $ueberstunden[2]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE4" value="<?php echo $ueberstunden[3]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <?php echo $ueberstunden[4]; ?> </td>
          <td> <input type="number" name="UE6" value="<?php echo $ueberstunden[5]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE7" value="<?php echo $ueberstunden[6]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE8" value="<?php echo $ueberstunden[7]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE9" value="<?php echo $ueberstunden[8]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE10" value="<?php echo $ueberstunden[9]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE11" value="<?php echo $ueberstunden[10]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE12" value="<?php echo $ueberstunden[11]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE13" value="<?php echo $ueberstunden[12]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE14" value="<?php echo $ueberstunden[13]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
          <td> <input type="number" name="UE15" value="<?php echo $ueberstunden[14]; ?>" onchange="validateUeberstunden(this.value, this.name)" /> </td>
        </tr>
      </tbody>
    </table>
    <input type="submit" class="btn btn-dark">
  </form>
</div>
<script>
  function validateSchichten(value, name) {
    if (document.getElementsByName(name)[0].value.length !== 0) {
      if (value < 1 || value > 3) {
        alert('Der Wert muss zwischen 1 und 3 liegen!')
        document.getElementsByName(name)[0].value = 5
      }
      let strValue = String(value)
      let split = strValue.split('.')
      if (split.length > 1) {
        alert('Der Wert darf keine Nachkommastelle haben!')
        document.getElementsByName(name)[0].value = 1
      } else {
        return
      }
    } else {
      document.getElementsByName(name)[0].value = 1
    }
  }

  function validateUeberstunden(value, name) {
    if (document.getElementsByName(name)[0].value.length !== 0) {
      if (value < 0 || value > 240) {
        alert('Der Wert muss zwischen 0 und 240 liegen!')
        document.getElementsByName(name)[0].value = 5
      }
      let strValue = String(value)
      let split = strValue.split('.')
      if (split.length > 1) {
        alert('Der Wert darf keine Nachkommastelle haben!')
        document.getElementsByName(name)[0].value = 0
      } else {
        return
      }
    } else {
      document.getElementsByName(name)[0].value = 0
    }
  }

  $("i").hover(
    function() {
      let span = document.createElement("span");
      span.innerHTML("hello" . $infoRuestZeitNeu[0][1]);
      $(this).append(span);
    }, function(){
      $(this).find("span").last().remove();
    }
  )
</script>

<footer class="bg-dark text-center text-white fixed-bottom" style="margin-top: 25px;">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2021 Alicia Grüneberg, Anne Matrusch, Niklas Uhr, Vincent Mielke
  </div>
</footer>
</body>

</html>