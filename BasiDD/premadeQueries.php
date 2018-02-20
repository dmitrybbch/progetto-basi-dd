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
include("charts.php");
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
//numero di opere create nel XX secolo
$query1 = "SELECT COUNT(*) as conto, year
            FROM artwork 
            WHERE year BETWEEN '1/01/1901' AND '31/12/2000' 
            GROUP BY year";
//numero di opere acquisite dai musei nel corso degli anni dalla fondazione di Tate Museum
$query2 = "SELECT COUNT(*) as conto, acquisition_year
            FROM artwork
            WHERE 1
            GROUP BY acquisition_year";
//numero di opere create dagli artisti di x nazionalità (usa place_of_birth)
$query3 = "SELECT a.name, COUNT(*) as conto
            FROM artwork o JOIN artist a
            ON o.artist_id = a.id
            WHERE a.place_of_birth LIKE '%{$birthplace}%'
            GROUP BY a.name";
//numero di opere fatte dagli artisti ancora vivi
$query4 = "SELECT COUNT(*) as conto, a.name
            FROM artwork o JOIN artist a
            ON o.artist_id = a.id
            WHERE year_of_death = ''
            GROUP BY a.name";
//ricevo il valore del submit
$query_scelta = $_POST['submit'];
$arrayx;
$arrayy;
$i=0;
switch($query_scelta){
        case "query1":
        $result = $mysqli_query($query1, $conn);
        while ($obj=mysqli_fetch_object($result))
        {
          $arrayx[$i] = $obj->conto;
          $arrayy[$i] = $obj->year;
          $i++;
        }
        break;
    case "query2":
        $result = $mysqli_query($query2, $conn);
        while ($obj=mysqli_fetch_object($result))
        {
          $arrayx[$i] = $obj->conto;
          $arrayy[$i] = $obj->acquisition_year;
        }
        break;
    case "query3":
        $result = $mysqli_query($query3, $conn);
        while ($obj=mysqli_fetch_object($result))
        {
          $arrayx[$i] = $obj->name;
          $arrayy[$i] = $obj->conto;
        }
        break;
    case "query4":
        $result = $mysqli_query($query4, $conn);
        while ($obj=mysqli_fetch_object($result))
        {
          $arrayx[$i] = $obj->conto;
          $arrayy[$i] = $obj->name;
        }
        break;
}
mysqli_free_result($result);

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
    ';*/
    
    $s1 = $arrayx;
    $ticks = $arrayy;
    
    $pc = new C_PhpChartX(array($s1),'chart1');
    $pc->add_plugins(array('highlighter','pointLabels'));
	$pc->set_animate(true);
	$pc->set_series_default(array(
		'renderer'=>'plugin::BarRenderer',
		'pointLabels'=> array('show'=>true)));
    $pc->set_axes(array(
         'xaxis'=>array(
			'renderer'=>'plugin::CategoryAxisRenderer',
			'ticks'=>$ticks)
    ));
    $pc->set_highlighter(array('show'=>false));
    $pc->bind_js('jqplotDataClick',array(
		'series'=>'seriesIndex',
		'point'=>'pointIndex',
		'data'=>'data'));
    $pc->draw(400,300);