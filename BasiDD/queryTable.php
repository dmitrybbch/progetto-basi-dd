<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = "root";
$password = "984yu54";
$servername = "localhost";
$dbname = "musei";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Mannaaggiaaaaaaaaa hai fallitoooo: " . $conn->connect_error);
}
include("tables.php");
$gender = "";
$array = [
    $nome = $_POST['name'],
    $birthyear = $_POST['birthyear'],
    $deathyear = $_POST['deathyear'],
    $birthplace = $_POST['birthplace'],
    $deathplace = $_POST['deathplace'],
    $gender
];
//controllo del valore di $gender
if(array_key_exists('gender', $_POST)){
  $gender = $_POST['gender'];
}
echo $gender;

$array2 = [
    $artistname = $_POST['artistname'],
    $artistrole = $_POST['artistrole'],
    $title = $_POST['title'],
    $creationyear = $_POST['creationyear'],
    $creationmethod = $_POST['creationmethod']
];
$sql = "SELECT id FROM ARTIST WHERE yearOfDeath=1911";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. "<br>";
  }
} else {
  echo "0 results";
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