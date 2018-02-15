<?php
//verifica della presenza di errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//connessione al database
$username = "root";
$password = "password";   ///Cambiare in base alla persona
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
$nome = $_POST['name'];
$birthyear = $_POST['birthyear'];
$deathyear = $_POST['deathyear'];
$birthplace = $_POST['birthplace'];
$deathplace = $_POST['deathplace'];

$sql = "SELECT * FROM artist WHERE 
  name LIKE '%{$nome}%' 
  AND year_of_birth LIKE '%{$birthyear}%'
  AND year_of_death LIKE '%{$deathyear}%'
  AND place_of_birth LIKE '%{$birthplace}%'
  AND place_of_death LIKE '%{$deathplace}%'";
  

print'
<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Da Big Table</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Birth Year</th>
                  <th>Death Year</th>
                  <th>Birth Place</th>
                  <th>Death Place</th>
                  <th>Gender</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Birth Year</th>
                  <th>Death Year</th>
                  <th>Birth Place</th>
                  <th>Death Place</th>
                  <th>Gender</th>
                </tr>
              </tfoot>
              <tbody>
';
if ($result=mysqli_query($conn,$sql))
  {
  while ($obj=mysqli_fetch_object($result)){
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
