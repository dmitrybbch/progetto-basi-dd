<?php

/*verifica della presenza di errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

header('Content-Type: application/json');
$conn = mysqli_connect("localhost","pippo","topolino","musei");

$sqlQuery = "SELECT COUNT(*) as conto_opere, acquisition_year FROM artwork GROUP BY acquisition_year";


$result = mysqli_query($conn,$sqlQuery);
$anniCount = array();
$dataC = array();
foreach ($result as $row) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);

?>