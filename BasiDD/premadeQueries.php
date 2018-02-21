<?php
//verifica della presenza di errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("./chartPhp/lib/inc/chartphp_dist.php");

//connessione al database
$username = "root";
$password = "password";
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

    // Output line
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
$arrayx = [];
$arrayy = [];
$i = 0;
switch($query_scelta){
    case "query1":
        $result = $mysqli_query($query1, $conn);
        while ($obj=mysqli_fetch_object($result))
        {
          $arrayx[$i] = $obj->year;
          $arrayy[$i] = $obj->conto;
          echo $arrayx[$i], $arrayy[$i];
          $i++;
        }
        break;
    case "query2":
        $result = $mysqli_query($query2, $conn);
        while ($obj=mysqli_fetch_object($result))
        {
          $arrayx[$i] = $obj->conto;
          $arrayy[$i] = $obj->acquisition_year;
          $i++;
        }
        break;
    case "query3":
        $result = $mysqli_query($query3, $conn);
        while ($obj=mysqli_fetch_object($result))
        {
          $arrayx[$i] = $obj->name;
          $arrayy[$i] = $obj->conto;
          $i++;
        }
        break;
    case "query4":
        $result = $mysqli_query($query4, $conn);
        while ($obj=mysqli_fetch_object($result))
        {
          $arrayx[$i] = $obj->conto;
          $arrayy[$i] = $obj->name;
          $i++;
        }
        break;
}
mysqli_free_result($result);

/*
// content="text/plain; charset=utf-8"
    require_once ('jpgraph/jpgraph.php');
    require_once ('jpgraph/jpgraph_line.php');
    
    // Setup the graph
    $graph = new Graph(300,250);
    $graph->SetScale("textlin");
    
    $theme_class=new UniversalTheme;
    
    $graph->SetTheme($theme_class);
    $graph->img->SetAntiAliasing(false);
    $graph->title->Set('Filled Y-grid');
    $graph->SetBox(false);
    
    $graph->img->SetAntiAliasing();
    
    $graph->yaxis->HideZeroLabel();
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);
    
    $graph->xgrid->Show();
    $graph->xgrid->SetLineStyle("solid");
    $graph->xaxis->SetTickLabels($arrayx);
    $graph->xgrid->SetColor('#E3E3E3');
    
    // Create the first line
    $p1 = new LinePlot($arrayy);
    $graph->Add($p1);
    $p1->SetColor("#6495ED");
    $p1->SetLegend('Line 1');

    $graph->legend->SetFrameWeight(1);
    
    // Output line
    $graph->Stroke();
*/
    /////////////// Graficooooooooooooooohhh
    $p = new chartphp(); 

    // data array is populated from example data file 
    $p->data = $line_chart_data; 
    $p->chart_type = "line"; 

    // Common Options 
    $p->title = "Line Chart"; 
    $p->xlabel = "Months"; 
    $p->ylabel = "Sales"; 
    $p->series_label = array("2014","2015","2016","2017"); 
    //$p->shape="vhv"; 
    //$p->options["axes"]["yaxis"]["tickOptions"]["prefix"] = '$'; 
    $p->color ="soft"; // Choices are "metro" "soft" 
    $out = $p->render('c1');

$conn->close();
/*
    // content="text/plain; charset=utf-8"
    require_once ('jpgraph/jpgraph.php');
    require_once ('jpgraph/jpgraph_line.php');
    
    // Setup the graph
    $graph = new Graph(300,250);
    $graph->SetScale("textlin");
    
    $theme_class=new UniversalTheme;
    
    $graph->SetTheme($theme_class);
    $graph->img->SetAntiAliasing(false);
    $graph->title->Set('Filled Y-grid');
    $graph->SetBox(false);
    
    $graph->img->SetAntiAliasing();
    
    $graph->yaxis->HideZeroLabel();
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);
    
    $graph->xgrid->Show();
    $graph->xgrid->SetLineStyle("solid");
    $graph->xaxis->SetTickLabels($arrayx);
    $graph->xgrid->SetColor('#E3E3E3');
    
    // Create the first line
    $p1 = new LinePlot($arrayy);
    $graph->Add($p1);
    $p1->SetColor("#6495ED");
    $p1->SetLegend('Line 1');

    $graph->legend->SetFrameWeight(1);
    
    // Output line
    $graph->Stroke();
 * */
 
