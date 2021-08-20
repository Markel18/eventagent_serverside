<?php

//Access: Authorized User & Admin
//Purpose: retrives all the contacts

require_once '../db_connect.php';

$currentDate = $_POST['currentDate'];
$department = $_POST['department'];
$address = $_POST['address'];
$location = $_POST['location'];
$producerId = $_POST['producerId'];
$code = $_POST['code'];
$animalType = $_POST['animalType'];
$cause = $_POST['cause'];
$medicineId = $_POST['medicineId'];
$dose = $_POST['dose'];
$manual = $_POST['manual'];
$meat = $_POST['meat'];
$milk = $_POST['milk'];
$egg = $_POST['egg'];
$honey = $_POST['honey'];
$otherNet = $_POST['otherNet'];
$comments = $_POST['comments'];
$prescriptionNumber = $_POST['prescriptionNumber'];
$uid = $_POST['uid'];

//$sqli = "INSERT INTO suntagografisi (dateSuntagografisi, tmhmaSuntagografisi, toposEkdosis, addressSuntagografisi, prodNameSuntagografisi, codeEktrofisSuntagografisi, eidosZwwnSuntagografisi, aitiaSuntagografisis, skeuasma, dosologia, odhgies, kreas, gala, auga, meli, alloi_istoi, parathrhseis, userPrescID, uid) VALUES (NOW(), '".$department."','".$address."','".$location."','".$producerId."','".$code."','".$animalType."','".$cause."','".$medicineId."','".$dose."','".$manual."','".$meat."','".$milk."','".$egg."','".$honey."','".$otherNet."','".$comments."','".$prescriptionNumber."','".$uid."')";
	

$sql = "INSERT INTO suntagografisi (dateSuntagografisi, tmhmaSuntagografisi, toposEkdosis, addressSuntagografisi, prodNameSuntagografisi, codeEktrofisSuntagografisi, eidosZwwnSuntagografisi, aitiaSuntagografisis, skeuasma, dosologia, odhgies, kreas, gala, auga, meli, alloi_istoi, parathrhseis, userPrescID, uid)
			VALUES (NOW(), :department, :address, :location, :producerId, :code, :animalType, :cause, :medicineId, :dose, :manual, :meat, :milk, :egg, :honey, :otherNet, :comments, :prescriptionNumber, :uid)";
	
$run = $dbh->prepare($sql);
$run->bindParam(':department',$department,PDO::PARAM_STR);
$run->bindParam(':address',$address,PDO::PARAM_STR);
$run->bindParam(':location',$location,PDO::PARAM_STR);
$run->bindParam(':producerId',$producerId,PDO::PARAM_INT);
$run->bindParam(':code',$code,PDO::PARAM_STR);
$run->bindParam(':animalType',$animalType,PDO::PARAM_STR);
$run->bindParam(':cause',$cause,PDO::PARAM_STR);
$run->bindParam(':medicineId',$medicineId,PDO::PARAM_INT);
$run->bindParam(':dose',$dose,PDO::PARAM_STR);
$run->bindParam(':manual',$manual,PDO::PARAM_STR);
$run->bindParam(':meat',$meat,PDO::PARAM_STR);
$run->bindParam(':milk',$milk,PDO::PARAM_STR);
$run->bindParam(':egg',$egg,PDO::PARAM_STR);
$run->bindParam(':honey',$honey,PDO::PARAM_STR);
$run->bindParam(':otherNet',$otherNet,PDO::PARAM_STR);
$run->bindParam(':comments',$comments,PDO::PARAM_STR);
$run->bindParam(':prescriptionNumber',$prescriptionNumber,PDO::PARAM_INT);
$run->bindParam(':uid',$uid,PDO::PARAM_INT);
 
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
