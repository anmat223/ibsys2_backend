<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require_once($documentRoot . '/ibsys2_backend/navbar_without_logik.php');

foreach (new DirectoryIterator($documentRoot . '/ibsys2_backend/uploads/') as $file) {
  if ($file->isDot()) continue;
  unlink($documentRoot . '/ibsys2_backend/uploads/' . $file->getFilename());
}

$output = $documentRoot . "/ibsys2_backend/resources/views/output.xml";

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
        <input type="submit" class="btn btn-dark" value="Upload File" name="submit">
      </div>
    </form>
  </div>
</div>
<footer class="bg-dark text-center text-white fixed-bottom" style="margin-top: 25px;">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2021 Alicia Grüneberg, Anne Matrusch, Niklas Uhr, Vincent Mielke
  </div>
</footer>
</body>

</html>