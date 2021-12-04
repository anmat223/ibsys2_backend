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
          <th scope="col" data-editable="true">Nr. Kaufteil</th>
          <th scope="col">Diskonntmenge</th>
          <th scope="col">Anfangsbestand</th>
          <th scope="col">P1</th>
          <th scope="col">P2</th>
          <th scope="col">P3</th>
          <th scope="col">P4</th>
          <th scope="col">Menge</th>
          <th scope="col">Bestellart</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($kaufteile as $teil) : ?>
          <tr class="item_row">
            <th scope="row"><?php echo $teil->nummer; ?></th>
            <td><?php echo $teil->diskontmenge; ?></td>
            <td><?php echo $teil->anzahl; ?></td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>
              <input type="text" name="<?php echo $teil->nummer ?>" />
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