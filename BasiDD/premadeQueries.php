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
//file da includere
include("tables.php");
//set delle variabili
$gender = "";
if(array_key_exists('gender', $_POST)){
  $gender = $_POST['gender'];
}
$nome = $_POST['name'];
$birthyear = $_POST['birthyear'];
$deathyear = $_POST['deathyear'];
$birthplace = $_POST['birthplace'];
$deathplace = $_POST['deathplace'];
$artistname = $_POST['artistname'];
$artistrole = $_POST['artistrole'];
$title = $_POST['title'];
$creationyear = $_POST['creationyear'];
$creationmethod = $_POST['creationmethod'];
//numero di opere create nel XIX secolo
$query1 = "SELECT COUNT(id) 
            FROM artwork 
            WHERE year BETWEEN #01/01/1901# AND #31/12/2000# 
            GROUP BY year";
//numero di opere acquisite dai musei nel corso degli anni
$query2 = "SELECT COUNT(*)
            FROM artwork
            WHERE 1
            GROUP BY acquisition_year";
//numero di opere create dagli artisti di x nazionalità
$query3 = "SELECT COUNT(*)
            FROM artwork o JOIN artist a
            ON o.artist_id = a.id
            WHERE a.place_of_birth LIKE '%{$birthplace}%'";
//numero di opere fatte dagli artisti ancora vivi
$query4 = "SELECT COUNT(*)
            FROM artwork o JOIN artist a
            ON o.artist_id = a.id
            WHERE year_of_death IS NULL";
//ricevo il valore del submit
$query_scelta = $_POST['submit'];

switch($query_scelta){
    case "query1":
        $mysqli_query($query1, $conn);
        printf_function($result);
        break;
    case "query2":
        $mysqli_query($query2, $conn);
        printf_function($result);
        break;
    case "query3":
        $mysqli_query($query3, $conn);
        printf_function($result);
        break;
    case "query4":
        $mysqli_query($query4, $conn);
        printf_function($result);
        break;
}
function print_result($result){
    while ($obj=mysqli_fetch_object($result))
    {
    printf("%s, %s <br>",$obj->id, $obj->name); //editare i campi da stampare
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