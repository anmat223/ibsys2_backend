<?php
session_start();
if (!array_key_exists('language', $_SESSION)) {
  $_SESSION["language"] = "DE";
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navigation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/index.php">Start<span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/resources/views/uploadXML.php">Upload XML</a>
        </li>
      </ul>
    </div>
  </nav>
  <input type="button" class="btn btn-dark" value="<?php echo $_SESSION['language'] ?>" id="languageswitcher" />
  <button class="btn btn-dark"><a style="color: white" target="_blank" href="https://drive.google.com/file/d/1S-Tahy58UwIkctyBixSG8UxVJHrLa45y/view?usp=sharing">Handbuch</a></button>

  <script>
    $('#languageswitcher').click(function() {
      // fire off the request to /redirect.php
      request = $.ajax({
        url: "/resources/views/changeLanguage.php",
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