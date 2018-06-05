<?php 
//index.php
$username = "phpmyadmin";
$password = "984yu54";   ///Cambiare in base alla persona
$servername = "localhost";
$dbname = "musei";

$sql = "SELECT COUNT(*) as numOpere FROM artwork WHERE year BETWEEN '1/01/2010' AND '31/12/2015' GROUP BY year";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Mannaaggiaaaaaaaaa hai fallitoooo: " . $conn->connect_error);
}
$nome = "";
$birthyear = "";
$deathyear = "";
$birthplace = "";
$deathplace = "";
$gender="";

if(array_key_exists('gender', $_POST)){
  $gender = $_POST['gender'];
}
$nome = $_POST['name'];
$birthyear = $_POST['birthyear'];
$deathyear = $_POST['deathyear'];
$birthplace = $_POST['birthplace'];
$deathplace = $_POST['deathplace'];

$sql = "SELECT * FROM artist WHERE 
  name LIKE '%{$nome}%' 
  AND gender = $gender
  AND year_of_birth LIKE '%{$birthyear}%'
  AND year_of_death LIKE '%{$deathyear}%'
  AND place_of_birth LIKE '%{$birthplace}%'
  AND place_of_death LIKE '%{$deathplace}%'";
$chart_data = '';
while($row = mysqli_fetch_array($sql))
{
 $chart_data .= "{ name:'".$row["name"]."', birthday:".$row["birthday"].", deathyear:".$row["deathyear"].", birthplace:".$row["birthplace"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Alcune query con grafici</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- PHP Chart creator styles -->
  <link rel="stylesheet" href="/lib/js/chartphp.css">

 <!-- COSE PER I GRAFICI -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
 <!-- /COSE PER I GRAFICI -->
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"> <img style="max-width:45%;" src="tate-logo.png"> Museum</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

    <!-- BARRA DI SINISTRA CON LE ALTRE PAGINE -->
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Homepage</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="charts.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Query e grafici</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="MakeYourQuery">
          <a class="nav-link" href="tables.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Ricerca di opere e artisti</span>
          </a>
        </li>        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Other Data">
          <a class="nav-link" href="otherData.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Other Data</span>
          </a>
        </li>
      </ul>
    <!-- TOGGLE SIDE NAV -->
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Charts</li>
      </ol>
      <!-- Area Chart -->      
      <div class="row mb-3">
        <div class="col-lg-8">
          <!--Bar Chart -->
		<div class="container" style="width:900px;">
		   <h2 align="center">Morris.js chart with PHP & Mysql</h2>
		   <h3 align="center">Last 10 Years Profit, Purchase and Sale Data</h3>   
		   <br /><br />
		   <div id="chart"></div>
		</div>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Bar Charts</div>
            <div class="card-body">
              <!--<canvas id="myBarChart" width="100" height="50"></canvas>-->
            </div>
            <div class="card-footer small">
              <!-- Menu a cascata -->
              <form action="premadeQueries.php" method="post" id="barChartQueryForm">
                <div class="form-group">
                  <label for="inputQueryBarChart">Select the data to show:</label>
                  <select class="form-control" id="inputQueryBarChart" onchange="this.form.submit()">
                    <option value="worksperyear">Works Per Year</option>
                    <option value="query1">Query 1</option>
                    <option value="query2">Query 2</option>
                    <option value="query3">Query 3</option>
                    <option value="query4">Query 4</option>
                  </select>
                </div>
                <div class="form-group">
                  <table>
                    <tr class="form-group">
                      <td><label for="birthyear"><strong>Anno di nascita: </strong></label></td>
                      <td><input type="text" name="birthyear" class="form-control" id="birthyear" placeholder="Anno di nascita dell'artista" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
                    </tr>
                    <tr>
                      <td><label for="deatyear"><strong>Anno di morte: </strong></label></td>
                      <td><input type="text" name="deathyear" class="form-control" id="deathyear" placeholder="Anno di nascita dell'artista" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
                    </tr>
                    <tr>
                      <td><label for="gender"><strong>Sesso: </strong></label></td>  
                      <td><input type="text" name="gender" class="form-control" id="gender"></td>
                    </tr>
                    <tr>
                      <td><label for="birthplace"><strong>Luogo di nascita: </strong></label></td>
                      <td><input type="text" name="birthplace" class="form-control" id="birthplace"></td>
                    </tr>
                    <tr>
                      <td><label for="deathplace"><strong>Luogo di morte: </strong></label></td> 
                      <td><input type="text" name="deathplace" class="form-control" id="deathplace"></td>
                    </tr>
                  </table>
                </div>
              </form>              
              <!-- /Menu a cascata -->
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Pie Chart -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Pie Charts</div>
            <div class="card-body">
              <!--<canvas id="myPieChart" width="100%" height="100"></canvas>-->
              
              <!--<canvas id="myBarChart" width="100" height="50"></canvas>-->
            </div>
            <div class="card-footer small">
              <!-- Menu a cascata -->
              <form action="chartQueries.php" method="post" id="barChartQueryForm" >
                <div class="form-group">
                  <label for="inputQueryBarChart">Select the data to show:</label>
                  <select class="form-control" id="inputQueryBarChart" onchange="this.form.submit()">
                    <option value="methodfrequency">Method Frequency</option>
                    <option value="query1">Query 1</option>
                    <option value="query2">Query 2</option>
                    <option value="query3">Query 3</option>
                    <option value="query4">Query 4</option>
                  </select>
                </div>
              </form>    
              <!-- /Menu a cascata -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-8">
          <!-- Card per l'inserimento dei dati-->
          <div class="card mb-3">
            <div class="card-header">
                <label>Data input</label>
            </div>
            <div class="card-body">
            <form action="premadeQueries.php" method="post" id="inputDataQueryForm">
                <div class="form-group">
                  <label for="inputQueryBarChart">Immetti i parametri per le ricerche:</label><br>
                  <table>
                    <tr class="form-group">
                      <td><label for="name"><strong>Anno di nascita: </strong></label></td>
                      <td><input type="text" name="birthyear"></td>
                    </tr>
                      <td><label for="name"><strong>Anno di morte: </strong></label></td>
                      <td><input type="text" name="deathyear"></td>
                    <tr>
                      <td><label for="name"><strong>Sesso: </strong></label></td>  
                      <td><input type="text" name="gender"></td>
                    </tr>
                    <tr>
                      <td><label for="name"><strong>Luogo di nascita: </strong></label></td>
                      <td><input type="text" name="birthplace"></td>
                    </tr>
                    <tr>
                      <td><label for="name"><strong>Luogo di morte: </strong></label></td> 
                      <td><input type="text" name="deathplace"></td>
                    <tr>
                  </table>
                </div>
              </form>
            </div>             
              <!-- /Menu a cascata -->
            </div>
          </div>
        </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Dmitry Babich & Vittorio Cavicchioli</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-charts.js"></script>
    <!-- PHP Chart creator js file -->
    <script src="lib/js/chartphp.js"></script>
    <script>
	Morris.Bar({
	 element : 'chart',
	 data:[<?php echo $chart_data; ?>],
	 xkey:'birthyear',
	 ykeys:['profit', 'purchase', 'sale'],
	 labels:['Profit', 'Purchase', 'Sale'],
	 hideHover:'auto',
	 stacked:true
	});
</script>
  </div>
</body>
</html>
