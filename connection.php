<?php

header('Content-Type: application/json');

//database

define('DB_HOST', '192.168.1.160');
define('DB_USERNAME', 'iotdata');
define('DB_PASSWORD', 'csir.ceeri');
define('DB_NAME', 'SHMDB');

//get connection

$mysqli= new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$mysqli){
    die("Connection Failed:" .$mysqli-> error);
}

//query to get data from the table

$query= sprintf("SELECT Temperature FROM ISL201 ORDER BY ISL201.Timestamp DESC");

//EXECUTE QUERY

$result= $mysqli->query($query);

//loop through the returned data

$data= array();
foreach ($result as $row){
    $data[]=$row;
}

$result-> close();

$mysqli-> close();

print json.encode($data);