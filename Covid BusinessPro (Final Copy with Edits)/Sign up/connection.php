<?php
    $servername="localhost";
    $username="veninatb";
    $password="Quincy7";
    $dbname="veninatb";
    $conn= new mysqli('localhost','veninatb','Quincy7','veninatb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>    
