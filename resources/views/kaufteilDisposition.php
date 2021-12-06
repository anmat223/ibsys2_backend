<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');
?>

<div>
  <form action="<?php echo 'sendKaufteile.php' ?>" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" data-editable="true" rowspan="2">Nr. Kaufteil</th>
          <th scope="col" rowspan="2">Lieferzeit</th>
          <th scope="col" colspan="3">Verwendung</th>
          <th scope="col" rowspan="2">Diskonntmenge</th>
          <th scope="col" rowspan="2">Anfangsbestand</th>
          <th scope="col" colspan="4">Bruttobedarf gemäß Produktionsprogramm</th>
          <th scope="col" rowspan="2">Menge</th>
          <th scope="col" rowspan="2">Bestellart</th>
        </tr>
        <tr>
          <th scope="col">1</th>
          <th scope="col">2</th>
          <th scope="col">3</th>
          <th scope="col">P1</th>
          <th scope="col">P2</th>
          <th scope="col">P3</th>
          <th scope="col">P4</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($kaufteile as $teil) : ?>
          <tr class="item_row">
            <th scope="row"><?php echo $teil->nummer; ?></th>
            <td><?php echo $teil->lieferzeit . " - " . $teil->lieferzeit + $teil->abweichung; ?></td>
            <td><?php echo $teil->p1; ?></td>
            <td><?php echo $teil->p2; ?></td>
            <td><?php echo $teil->p3; ?></td>
            <td><?php echo $teil->diskontmenge; ?></td>
            <td><?php echo $teil->anzahl; ?></td>
            <td><?php
                $produktionsprogrammP1 = $_SESSION['produktionsprogrammMitPrognosen'][0];
                echo $teil->p1 * $produktionsprogrammP1[0] + $teil->p2 * $produktionsprogrammP1[1] + $teil->p3 * $produktionsprogrammP1[2]; ?>
            </td>
            <td><?php
                $produktionsprogrammP2 = $_SESSION['produktionsprogrammMitPrognosen'][1];
                echo $teil->p1 * $produktionsprogrammP2[0] + $teil->p2 * $produktionsprogrammP2[1] + $teil->p3 * $produktionsprogrammP2[2]; ?>
            </td>
            <td><?php
                $produktionsprogrammP3 = $_SESSION['produktionsprogrammMitPrognosen'][2];
                echo $teil->p1 * $produktionsprogrammP3[0] + $teil->p2 * $produktionsprogrammP3[1] + $teil->p3 * $produktionsprogrammP3[2]; ?>
            </td>
            <td><?php
                $produktionsprogrammP4 = $_SESSION['produktionsprogrammMitPrognosen'][3];
                echo $teil->p1 * $produktionsprogrammP4[0] + $teil->p2 * $produktionsprogrammP4[1] + $teil->p3 * $produktionsprogrammP4[2]; ?>
            </td>
            <td>
              <input type="text" name="<?php echo $teil->nummer ?>" value="0" />
            </td>
            <td>
              <select name="<?php echo $teil->nummer ?>_art">
                <option value="N">Normal</option>
                <option value="E">Eil</option>
              </select>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <input type="submit" />
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>