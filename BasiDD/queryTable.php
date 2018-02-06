<?php

$username = "phpmyadmin";
$password = "password";
$servername = "localhost";

$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Mannaaggiaaaaaaaaa hai fallitoooo: " . $conn->connect_error);
} 
include("tables.php");

$array = [
    $nome = $_POST['name'],
    $birthyear = $_POST['birthyear'],
    $deathyear = $_POST['deathyear'],
    $birthplace = $_POST['birthplace'],
    $deathplace = $_POST['deathplace'],
    $artistname = $_POST['artistname'],
    $artistrole = $_POST['artistrole'],
    $title = $_POST['title'],
    $creationyear = $_POST['creationyear'],
    $creationmethod = $_POST['creationmethod'],
    $gender = $_POST['gender']
];
$cueri = http_build_query($array);
echo $cueri;
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

