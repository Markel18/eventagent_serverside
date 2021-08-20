<?php

//Access: Authorized User & Admin
//Purpose: retrives all the contacts

require_once '../db_connect.php';

$uid = $_GET['id'];
$sql = "SELECT * FROM medicines where uid=:uid";
$run = $dbh->prepare($sql);
$run->bindParam(':uid', $uid , PDO::PARAM_INT);
$run->execute();

if ($run->rowCount() > 0) {
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		$fetch['medicines'][] = $row;
	}
} 

$sql = "SELECT * FROM producer where uid=:uid";
$run = $dbh->prepare($sql);
$run->bindParam(':uid', $uid , PDO::PARAM_INT);
$run->execute();

if ($run->rowCount() > 0) {
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		$fetch['producers'][] = $row;
	}
}
	

$sql = "SELECT MAX(userPrescID)+1 AS userPrescID FROM suntagografisi";
$run = $dbh->prepare($sql);
$run->execute();
$temp_num = 0;

if ($run->rowCount() > 0) {
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		$temp_num = $row['userPrescID'];
	}
}

$fetch['prescriptionNumber'] = $temp_num+1;

echo json_encode($fetch);
