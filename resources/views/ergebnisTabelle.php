<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>ErgebnisTabelle</title>
      </head>
      <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Navigation</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="../../index.php">Home <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./uploadXML.html">Upload XML</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./produktionsProgramm.php">Produktionsprogramm</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./kapazitaetsplan.php">Kapazitätsplan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./kaufteilDisposition.php">KaufteilDisposition</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./ergebnisTabelle.php">ErgebnisTabelle</a>
              </li>
              
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </nav>
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
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      </body>
</html>