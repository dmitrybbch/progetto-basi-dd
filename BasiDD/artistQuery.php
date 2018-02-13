<?php
//verifica della presenza di errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//connessione al database
$username = "root";
$password = "984yu54";
$servername = "localhost";
$dbname = "musei";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// controllo della connessione
if ($conn->connect_error) {
    die("Mannaaggiaaaaaaaaa hai fallitoooo: " . $conn->connect_error);
}
include("tables.php");
$nome = "";
$birthyear = "";
$deathyear = "";
$birthplace = "";
$deathplace = "";
$gender="";

if(array_key_exists('gender', $_POST)){
  $gender = $_POST['gender'];
}
$array = [
    $nome = $_POST['name'],
    $birthyear = $_POST['birthyear'],
    $deathyear = $_POST['deathyear'],
    $birthplace = $_POST['birthplace'],
    $deathplace = $_POST['deathplace'],
    $gender
];

$sql = "SELECT * FROM artist WHERE 
  name LIKE '%{$nome}%' 
  AND year_of_birth LIKE '%{$birthyear}%'
  AND year_of_death LIKE '%{$deathyear}%'
  AND place_of_birth LIKE '%{$birthplace}%'
  AND place_of_death LIKE '%{$deathplace}%'";
  
if ($result=mysqli_query($conn,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
    printf("%s, %s <br>",$obj->id, $obj->name);
    }
  // Free result set
  mysqli_free_result($result);
}
$conn->close();
/*echo $result;
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
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    ';