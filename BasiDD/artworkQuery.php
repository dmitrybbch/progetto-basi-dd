<?php
//verifica della presenza di errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//connessione al database
$username = "root";
$password = "password"; ///Cambiare in base alla persona
$servername = "localhost";
$dbname = "musei";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// controllo della connessione
if ($conn->connect_error) {
    die("Mannaaggiaaaaaaaaa hai fallitoooo: " . $conn->connect_error);
}
include("tables.php");
$artistname = "";
$artistrole = "";
$title = "";
$creationyear = "";
$creationmethod = "";

$artistname = $_POST['artistname'];
$artistrole = $_POST['artistrole'];
$title = $_POST['title'];
$creationyear = $_POST['creationyear'];
$creationmethod = $_POST['creationmethod'];

$sql = "SELECT * FROM artwork WHERE 
  artist LIKE '%{$artistname}%' 
  AND artist_role LIKE '%{$artistrole}%'
  AND title LIKE '%{$title}%'
  AND year LIKE '%{$creationyear}%'
  AND medium LIKE '%{$creationMethod}%'";
  


print'
<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Da Big Table</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot>
              <tbody>
';
if ($result=mysqli_query($conn,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
      print'<tr>';
      printf("<td>%s</td> <td>%s</td>",$obj->id, $obj->name);
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
';

$conn->close();
