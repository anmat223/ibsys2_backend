<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');
?>
<div>
  <div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" data-editable="true" colspan="2">Direktverkäufe</th>
          <th scope="col" colspan="3">Einkaufsaufträge</th>
          <th scope="col" colspan="2">Produktionsaufträge</th>
          <th scope="col" colspan="3">Produktionskapazitäten</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Teile Nr.</th>
          <th scope="row">Anzahl</th>
          <th scope="row">Teile Nr.</th>
          <th scope="row">Anzahl</th>
          <th scope="row">N / E</th>
          <th scope="row">Teile Nr.</th>
          <th scope="row">Anzahl</th>
          <th scope="row">Arbeitsplatz</th>
          <th scope="row">Schichten(1,2,3)</th>
          <th scope="row">Überstunden (min/Tag) </th>
        </tr>
        <tr>
          <th scope="col">1</th>
          <th scope="col">1</th>
          <th scope="col">1</th>
          <th scope="col">1</th>
          <th scope="col">1</th>
          <th scope="col">1</th>
          <th scope="col">1</th>
          <th scope="col">1</th>
          <th scope="col">1</th>
          <th scope="col">1</th>
        </tr>
      </tbody>
    </table>
  </div>
  <button type="button" class="btn btn-primary">Download XML</button>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>