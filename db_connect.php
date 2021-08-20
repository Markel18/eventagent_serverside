<?php

//Access: Authorized User & Admin
//Purpose: helper to login to the database

$servername = "localhost";
$username = "id16943115_skidrow17";
$password = "7@t%bV@Ka@]^VSk$";
$database = "id16943115_evetagenda";


try
{
 $dbh = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
 $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 $dbh->query('set character_set_client=utf8mb4');
 $dbh->query('set character_set_connection=utf8mb4');
 $dbh->query('set character_set_results=utf8mb4');
 $dbh->query('set character_set_server=utf8mb4');
}
catch(PDOException $e)
{
//die('Connection error:' . $pe->getmessage()); 
die('Connection error:' . $e->getmessage()); 
}