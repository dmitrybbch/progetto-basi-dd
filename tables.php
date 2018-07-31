<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Make Your Query</title>
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
            <span class="nav-link-text">Dashboard</span>
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

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="The Biggest of The Biggest">
              <a class="nav-link" href="otherData.php">
                  <i class="fa fa-fw fa-link"></i>
                  <span class="nav-link-text">The Biggest of The Biggest</span>
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
<!-- SCHEDE DI MERDA -->
      
  
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Tables</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Find Wannabe Artists and Artworks
        </div>
        <div class="card-body">
          <div style="float: left">
            <form method="post" action="artistQuery.php" id="artistForm">
              <table class="formTable">
                <tr>
                  <td colspan="2">
                    <legend>
                      <p><strong>Artists:</strong></p>
                    </legend>
                  </td>
                </tr>
                <tr class="form-group">
                  <td><label for="name"><strong>Name: </strong></label></td>
                  <td><input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"></td>        
                </tr>
                <tr class="form-group">
                  <td><label for="birthyear"><strong>Birth Year: </strong></label></td>
                  <td><input type="text" name="birthyear" class="form-control" id="birthyear" placeholder="Enter Birth Year" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
                </tr>
                <tr class="form-group">
                  <td><label for="deathyear"><strong>Death Year: </strong></label></td>
                  <td><input type="text" name="deathyear" class="form-control" id="deathyear" placeholder="Enter Death Year" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
                </tr>
                <tr class="form-group">
                  <td><label for="birthplace"><strong>Place of B.: </strong></label></td>
                  <td><input type="text" name="birthplace" class="form-control" id="birthplace" placeholder="Enter Place of Birth"></td>
                </tr>
                <tr class="form-group">
                  <td><label for="deathplace"><strong>Place of D.: </strong></label></td>
                  <td><input type="text" name="deathplace" class="form-control" id="deathplace" placeholder="Enter Place of Death"></td>
                </tr>
                <tr class="form-group">
                  <td><input type="radio" name="gender" value="male">Male</td>
                  <td><input type="radio" name="gender" value="female" style="margin-left: 5px">Female</td>
                </tr>
              </table>
            </form>
              
            <button form="artistForm" type="submit" class="btn btn-default" style="display: block; margin-top: 20px; position: relative; margin-left: 18%">Submit</button>
          </div>
              <!-- TABELLA OPERE -->
          <p></p>
          <div style="float: left">
            <form method="post" action="artworkQuery.php" id="artworkForm">
              <table class="formTable">
                <tr>
                  <td colspan="2" class="tableSecondSet">
                    <legend>
                      <p><strong>Works:</strong></p>
                    </legend>
                  </td>
                </tr>
                <tr class="form-group">
                  <td class="tableSecondSet"><label for="artistname"><strong>Art. Name: </strong></label></td>
                  <td><input type="text" name="artistname" class="form-control" id="artistname" placeholder="Enter Artist Name"></td>
                </tr>
                <tr class="form-group">
                  <td class="tableSecondSet"><label for="artistrole"><strong>Artist Role: </strong></label></td>
                  <td><input type="text" name="artistrole" class="form-control" id="artistrole" placeholder="Enter Artist Role"></td>
                </tr>
                <tr class="form-group">
                  <td class="tableSecondSet"><label for="title"><strong>Title: </strong></label></td>
                  <td><input type="text" name="title" class="form-control" id="title" placeholder="Enter Title"></td>
                </tr>
                <tr class="form-group">
                  <td class="tableSecondSet"><label for="creationyear"><strong>Creation Year: </strong></label></td>
                  <td><input type="text" name="creationyear" class="form-control" id="creationyear" placeholder="Enter Creation Year" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
                </tr>
                <tr class="form-group">
                  <td class="tableSecondSet"><label for="creationmethod"><strong>Method: </strong></label></td>
                  <td><input type="text" name="creationmethod" class="form-control" id="creationmethod" placeholder="Enter Creation Method"></td>
                </tr>
              </table>
            </form>
            <button form="artworkForm" type="submit" class="btn btn-default" style="display: block; margin-top: 20px; position: relative; margin-left: 18%">Submit</button>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    

</body>

</html>
