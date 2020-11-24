<?php
    $servername="localhost";
    $username="ense374";
    $password="Ense374team#";
    $dbname="CovidApp";
    $conn= new mysqli('localhost','ense374','Ense374team#','CovidApp');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>    