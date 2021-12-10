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
require './classes/services/Database_Service.php';

$database = new DatabaseService();
$database->createDatabase();
$database->createTables();
$database->insertPredifinedData();
?>

<h1><?php if ($_SESSION['language'] == "DE") {
      echo "Willkommen im IBSYS 2 Rechner!";
    } else {
      echo "Welcome to the IBSYS 2 Calculator!";
    }
    ?></h1>
<input type="button" value="<?php echo $_SESSION['language'] ?>" id="languageswitcher" />
<input type="button" value="Start" onclick="parent.location='/ibsys2_backend/resources/views/uploadXML.php'" />
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
include './footer.php';
