<?php

//Access: Authorized User & Admin
//Purpose: retrives all the contacts

require_once '../db_connect.php';
$uid = $_GET['id'];
$sql = "SELECT * FROM medicines where uid=:uid";
$run = $dbh->prepare($sql);
$run->bindParam(':uid',$uid,PDO::PARAM_INT);
$run->execute();

if ($run->rowCount() > 0) {
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$fetch['medicines'][] = $row;
			$fetch['error']['errorCode'] = "200";
		}
	} else {
		$fetch['error']['errorCode'] = "204";
	}
echo json_encode($fetch);