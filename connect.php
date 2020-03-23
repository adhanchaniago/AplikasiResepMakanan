<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "warteg_online";
$con = new mysqli($host,$user,$pass,$dbName);
if($con->connect_error)die($con->connect_error);