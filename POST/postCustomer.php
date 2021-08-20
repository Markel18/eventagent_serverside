<?php

//Access: Authorized User & Admin
//Purpose: retrives all the contacts

require_once '../db_connect.php';

$prodFLname = $_REQUEST['prodFLname'];
$prodPhone = $_REQUEST['prodPhone'];
$prodEmail = $_REQUEST['prodEmail'];
$prodCodeEktrofis = $_REQUEST['prodCodeEktrofis'];
$prodAFM = $_REQUEST['prodAFM'];
$prodDOY = $_REQUEST['prodDOY'];
$prodArea = $_REQUEST['prodArea'];
$prodNumAnimals = $_REQUEST['prodNumAnimals'];
$prodTypeAnimals = $_REQUEST['prodTypeAnimals'];
$prodFiliAnimals = $_REQUEST['prodFiliAnimals'];
$uid = $_REQUEST['uid'];

$sql = "INSERT INTO producer (registerDate,prodFLname, prodPhone, prodEmail, prodCodeEktrofis, prodAFM, prodDOY, prodArea, prodNumAnimals, prodTypeAnimals, prodFiliAnimals, uid)
			VALUES (NOW(), :prodFLname, :prodPhone, :prodEmail, :prodCodeEktrofis, :prodAFM, :prodDOY, :prodArea, :prodNumAnimals, :prodTypeAnimals, :prodFiliAnimals, :uid)";

$run = $dbh->prepare($sql);
$run->bindParam(':prodFLname',$prodFLname,PDO::PARAM_STR);
$run->bindParam(':prodPhone',$prodPhone,PDO::PARAM_INT);
$run->bindParam(':prodEmail',$prodEmail,PDO::PARAM_STR);
$run->bindParam(':prodCodeEktrofis',$prodCodeEktrofis,PDO::PARAM_STR);
$run->bindParam(':prodAFM',$prodAFM,PDO::PARAM_STR);
$run->bindParam(':prodDOY',$prodDOY,PDO::PARAM_STR);
$run->bindParam(':prodArea',$prodArea,PDO::PARAM_STR);
$run->bindParam(':prodNumAnimals',$prodNumAnimals,PDO::PARAM_INT);
$run->bindParam(':prodTypeAnimals',$prodTypeAnimals,PDO::PARAM_STR);
$run->bindParam(':prodFiliAnimals',$prodFiliAnimals,PDO::PARAM_STR);
$run->bindParam(':uid',$uid,PDO::PARAM_STR);
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
