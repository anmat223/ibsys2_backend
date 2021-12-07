<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/classes/services/Database_Service.php');

$database = new DatabaseService();
require_once($documentRoot . '/ibsys2_backend/navbar.php');
?>
<div class="container">
  <div class="row">
    <h1><?php if ($_SESSION['language'] == "DE") {
    echo "XML Datei hochladen";
  } else {
    echo "Upload XML File";
  }
  ?></h1>
  </div>
  <div class="row">
    <form action="../../classes/services/Upload_File_Service.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="fileToUpload">Select File to Upload</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
      </div>
    </form>
  </div>
</div>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>