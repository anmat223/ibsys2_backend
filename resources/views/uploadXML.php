<?php
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

$output = $documentRoot . "/ibsys2_backend/resources/views/output.xml";
$input = $documentRoot . "/ibsys2_backend/uploads/daten.xml";

if (file_exists($input)) {
  unlink($input);
}
if (file_exists($output)) {
  unlink($output);
}
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