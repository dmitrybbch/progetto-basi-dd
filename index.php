<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tate Museum</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

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

<!-- ALTRE SCHEDE --->

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Homepage</a>
            </li>
            <li class="breadcrumb-item active">Index</li>
        </ol>
        <!-- Example DataTables Card-->

        <?php
        //connessione al database
        $username = "pippo";
        $password = "topolino";
        $servername = "localhost";
        $dbname = "musei";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // controllo della connessione
        if ($conn->connect_error) {
            die("Mannaaggiaaaaaaaaa hai fallitoooo: " . $conn->connect_error);
        }
        
		//query sugli artisti contribuenti
		
        $sql = "SELECT name, COUNT(*) as num_opere FROM `artist` LEFT JOIN `artwork` ON artist.id = artist_id GROUP BY name ORDER BY num_opere DESC";

        print'
<div class="content-wrapper">
<div class="container-fluid">
<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Artisti più contribuenti</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Amount of artworks made</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Amount of artworks made</th>
                </tr>
              </tfoot>
              <tbody>
';
        if ($result=mysqli_query($conn,$sql))
        {
            while ($obj=mysqli_fetch_object($result)){
                print'<tr>';
                printf("<td>%s</td><td>%s</td>",$obj->name, $obj->num_opere);
                print'</tr>';
            }
            // Free result set
            mysqli_free_result($result);
        }

        print'
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
</div>
</div>
';
        
        //query sulle opere esposte 
		
        $sql = "SELECT title, medium, width, height, units, url, width*height/100 as dim_art FROM `artwork` WHERE artist_id = 558 ORDER BY dim_art DESC LIMIT 25";

        print'

<div class="content-wrapper">
<div class="container-fluid">
<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Some artworks by Joseph Mallord William Turner</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>Title</th>
                  <th>Medium</th>
                  <th>Width</th>
				  <th>Height</th>
                  <th>Units</th>
				  <th>Artwork webpage</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Title</th>
                  <th>Medium</th>
                  <th>Width</th>
				  <th>Height</th>
                  <th>Units</th>
				  <th>Artwork webpage</th>
                </tr>
              </tfoot>
              <tbody>
';
        if ($result=mysqli_query($conn,$sql))
        {
            while ($obj=mysqli_fetch_object($result)){
                print'<tr>';
                printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>",$obj->title, $obj->medium, $obj->width, $obj->height, $obj->units, "<a href=".$obj->url.">Webpage</a>");
                print'</tr>';

            }
            // Free result set
            mysqli_free_result($result);
        }

        print'
              </tbody>
            </table>
          </div>
        </div>
		</div>
		</div>
      </div>


';

        ?>

        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
        <!--<footer class="sticky-footer">
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
        <script src="vendor/datatables/jquery.dataTables.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin.min.js"></script>
        <!-- Custom scripts for this page-->
        <script src="js/sb-admin-datatables.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>


</body>

</html>
