<?php

require_once '../db_connect.php';

$customerId = $_REQUEST['customerId'];
$uId = $_REQUEST['id'];

$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$code = $_REQUEST['code'];
$afm = $_REQUEST['afm'];
$doy = $_REQUEST['doy'];
$area = $_REQUEST['area'];
$num_of_animals = $_REQUEST['num_of_animals'];
$animal_type = $_REQUEST['animal_type'];
$animal_tribe = $_REQUEST['animal_tribe'];


$sql = "UPDATE producer SET prodFLname=:name ,prodPhone=:phone ,prodEmail=:email ,prodCodeEktrofis=:code ,prodAFM=:afm ,prodDOY=:doy, prodArea=:area, prodNumAnimals=:num_of_animals, prodTypeAnimals=:animal_type, prodFiliAnimals=:animal_tribe WHERE prodID=:customerId AND uid = :uId";
$run= $dbh->prepare($sql);
$run->bindParam(':customerId', $customerId , PDO::PARAM_INT);
$run->bindParam(':uId', $uId , PDO::PARAM_INT);

$run->bindParam(':phone', $phone , PDO::PARAM_STR);
$run->bindParam(':name', $name , PDO::PARAM_STR);
$run->bindParam(':email', $email , PDO::PARAM_STR);
$run->bindParam(':code', $code , PDO::PARAM_STR);
$run->bindParam(':afm', $afm , PDO::PARAM_STR);
$run->bindParam(':doy', $doy , PDO::PARAM_STR);
$run->bindParam(':area', $area , PDO::PARAM_STR);
$run->bindParam(':num_of_animals', $num_of_animals , PDO::PARAM_STR);
$run->bindParam(':animal_type', $animal_type , PDO::PARAM_STR);
$run->bindParam(':animal_tribe', $animal_tribe , PDO::PARAM_STR);

$run->execute();

if ($run->rowCount() > 0) {
	$fetch['errorCode'] = "200";
} else {
	$fetch['errorCode'] = "201";
}

$myfile = fopen("../log_file.txt", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($fetch));
fclose($myfile);
echo json_encode($fetch);