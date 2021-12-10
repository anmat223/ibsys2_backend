<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>Index</title>
</head>
<?php
session_start();
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

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
        <input type="submit" value="Upload File" name="submit">
      </div>
    </form>
  </div>
</div>
<input type="button" value="<?php echo $_SESSION['language'] ?>" id="languageswitcher" />
<script>
  $('#languageswitcher').click(function() {
    // fire off the request to /redirect.php
    request = $.ajax({
      url: "/ibsys2_backend/resources/views/changeLanguage.php",
      type: "post",
      data: 'language'
    });

    // callback handler that will be called on success
    request.done(function(response, textStatus, jqXHR) {
      // log a message to the console
      location.reload();
      console.log("Hooray, it worked!");
    });

    // callback handler that will be called on failure
    request.fail(function(jqXHR, textStatus, errorThrown) {
      // log the error to the console
      console.error(
        "The following error occured: " +
        textStatus, errorThrown
      );
    });
  });
</script>
<?php
require_once($documentRoot . '/ibsys2_backend/footer.php');
?>