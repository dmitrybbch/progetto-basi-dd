<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Charts</title>
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
    <a class="navbar-brand" href="index.php"> <img style="max-width:45%;" src="tate-logo.png"> Museum</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

    <!-- BARRA DI SINISTRA CON LE ALTRE PAGINE -->
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Homepage">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Homepage</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="chart.php">
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
          <a href="#">Homepage</a>
        </li>
        <li class="breadcrumb-item active">Chart</li>
      </ol>

      <div class="row">
        <div class="col-lg-8">
          <!-- Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Number of works per Year</div>
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
                                    //console.log(data);
                                    var years = [];
                                    var works = [];

                                    for (var i in data) {
                                        years.push(data[i].year);
                                        works.push(data[i].conto_opere);

                                    }

                                    var chartdata = {
                                        labels: years,
                                        datasets: [
                                            {
                                                label: 'Number of Works',
                                                backgroundColor: '#000080',
                                                borderColor: '#46d5f1',
                                                hoverBackgroundColor: '#CCCCCC',
                                                hoverBorderColor: '#666666',
                                                data: works
                                            }
                                        ]
                                    };

                                    var graphTarget = $("#graphCanvas");

                                    var barGraph = new Chart(graphTarget, {
                                        type: 'bar',
                                        data: chartdata
                                    });
                                    //console.log(data);
                                });
                        }
                    }
                </script>
            </div>
          </div>
          
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Number of works per acquisition year</div>
            <div class="card-body">
              <!--<canvas id="myBarChart" width="100" height="50"></canvas>-->
                <div id="chart-container">
                    <canvas id="graphCanvas2"></canvas>
                </div>
                <script>
                    $(document).ready(function () {
                        showGraf();
                    });


                    function showGraf()
                    {
                        {
                            $.post("worksPerAcY.php",
                                function (data)
                                {
                                    //console.log(data);
                                    var years = [];
                                    var works = [];

                                    for (var i in data) {
                                        years.push(data[i].acquisition_year);
                                        works.push(data[i].conto_opere);

                                    }

                                    var chartdata = {
                                        labels: years,
                                        datasets: [
                                            {
                                                label: 'Number of Works',
                                                backgroundColor: '#008080',
                                                borderColor: '#46d5f1',
                                                hoverBackgroundColor: '#CCCCCC',
                                                hoverBorderColor: '#666666',
                                                data: works
                                            }
                                        ]
                                    };

                                    var graphTarget = $("#graphCanvas2");

                                    var barGraph = new Chart(graphTarget, {
                                        type: 'bar',
                                        data: chartdata
                                    });
                                    //console.log(data);
                                });
                        }
                    }
                </script>
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Nobody 2018</small>
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
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
