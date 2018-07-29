<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pies And Charts</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
  
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"> <img style="max-width:45%;" src="tate-logo.png"> Wannabe Museum</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

    <!-- BARRA DI SINISTRA CON LE ALTRE PAGINE -->
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="charts.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="MakeYourQuery">
          <a class="nav-link" href="tables.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Make your query</span>
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
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Area Chart Example</div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Bar Chart Example</div>
            <div class="card-body">
              <!--<canvas id="myBarChart" width="100" height="50"></canvas>-->
                <div id="chart-container">
                    <canvas id="graphCanvas"></canvas>
                </div>
                <script>
                    $(document).ready(function () {
                        showGraph();
                    });


                    function showGraph()
                    {
                        {
                            $.post("worksPerYear.php",
                                function (data)
                                {
                                    console.log(data);
                                    var name = [];
                                    var marks = [];

                                    for (var i in data) {
                                        name.push(data[i].year);
                                        marks.push(data[i].conto_opere);

                                    }

                                    var chartdata = {
                                        labels: name,
                                        datasets: [
                                            {
                                                label: 'Works per year',
                                                backgroundColor: '#49e2ff',
                                                borderColor: '#46d5f1',
                                                hoverBackgroundColor: '#CCCCCC',
                                                hoverBorderColor: '#666666',
                                                data: marks
                                            }
                                        ]
                                    };

                                    var graphTarget = $("#graphCanvas");

                                    var barGraph = new Chart(graphTarget, {
                                        type: 'bar',
                                        data: chartdata
                                    });
                                });
                        }
                    }
                </script>
            </div>

            <!-- MENU A CASCATA -->
              <form action="worksPerYear.php" method="post" id="barChartQueryForm">
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
              <!-- /MENU A CASCATA-->
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Sesso degli artisti</div>
            <div class="card-body">
              <canvas id="pieChart" width="100%" height="100"></canvas>
            </div>

            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
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
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
