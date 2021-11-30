<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Kapazitätsplan</title>
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
                <a class="nav-link" href="./kapazitaetsplan.php">Kapazitätsplan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./produktionsProgramm.php">Produktionsprogramm</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./uploadXML.html">Upload XML</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </nav>
        <div>
        <?php
          //require '../../classes/services/XML_Reader_Service.php';
          //$XML_Reader = new XML_Reader_Service();
          //$waitinglist = $XML_Reader->get_waitingliststock();
           // $ordersinwork = $XML_Reader->get_ordersinwork();
          $kaprueckstand = array();
          for($i=0;$i < 15; ++$i){
           // $kaprueckstand[$i] = $waitinglist[$i] + $ordersinwork[$i];
            $kaprueckstand[$i] = 1; 
          }
           // DB abfragen
          $ruestzeitNeu = [];
          require '../../classes/services/Database_Service.php';
          $database = new DatabaseService();
          $ruestzeitNeu = $database->read("Arbeitsplatz","ruestzeit",$order ="nummer");   
         // print_r( $ruestzeitNeu); Zur Ansicht des arrays
        ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" data-editable="true">Kapazitätsplan</th>
                        <th scope="col">1</th>
                        <th scope="col">2</th>
                        <th scope="col">3</th>
                        <th scope="col">4</th>
                        <th scope="col">5</th>
                        <th scope="col">6</th>
                        <th scope="col">7</th>
                        <th scope="col">8</th>
                        <th scope="col">9</th>
                        <th scope="col">10</th>
                        <th scope="col">11</th>
                        <th scope="col">12</th>
                        <th scope="col">13</th>
                        <th scope="col">14</th>
                        <th scope="col">15</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Kapazitätsbedarf(neu)</th>
                        <td>3000</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">Rüstzeit(neu)</th>
                        <td> <?php echo $ruestzeitNeu[0]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[1]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[2]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[3]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[4]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[5]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[6]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[7]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[8]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[9]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[10]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[11]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[12]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[13]["ruestzeit"] ?> </td>
                        <td> <?php echo $ruestzeitNeu[14]["ruestzeit"] ?> </td>
                      </tr>
                      <tr>
                        <th scope="row">Kap.bed.(Rückstand Vorperiode)</th>
                        <td> <?php echo $kaprueckstand[0];?> </td>
                        <td> <?php echo $kaprueckstand[1];?> </td>
                        <td> <?php echo $kaprueckstand[2];?> </td>
                        <td> <?php echo $kaprueckstand[3];?> </td>
                        <td> <?php echo $kaprueckstand[4];?> </td>
                        <td> <?php echo $kaprueckstand[5];?> </td>
                        <td> <?php echo $kaprueckstand[6];?> </td>
                        <td> <?php echo $kaprueckstand[7];?> </td>
                        <td> <?php echo $kaprueckstand[8];?> </td>
                        <td> <?php echo $kaprueckstand[9];?> </td>
                        <td> <?php echo $kaprueckstand[10];?> </td>
                        <td> <?php echo $kaprueckstand[11];?> </td>
                        <td> <?php echo $kaprueckstand[12];?> </td>
                        <td> <?php echo $kaprueckstand[13];?> </td>
                        <td> <?php echo $kaprueckstand[14];?> </td>
                      </tr>
                      <tr>
                        <th scope="row">Rüstzeit(Rückstand Vorperiode)</th>
                        <td>3000</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">Gesamt-Kapazitätsbedarf</th>
                        <td>3000</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">Schichten</th>
                        <td>3000</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">Überstunden</th>
                        <td>3000</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                </tbody>
            </table>          
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      </body>
</html>