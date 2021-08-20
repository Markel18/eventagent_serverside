<?php

//Access: Authorized User & Admin
//Purpose: retrives all the contacts

require_once '../db_connect.php';

$uid = $_GET['id'];
$sql = "SELECT * FROM event where uid=:uid";
$run = $dbh->prepare($sql);
$run->bindParam(':uid', $uid , PDO::PARAM_INT);
$run->execute();

if ($run->rowCount() > 0) {
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$fetch['events'][] = $row;
			$fetch['error']['error_code'] = "200";
		}
	} else {
		$fetch['error']['error_code'] = "204";
	}
echo json_encode($fetch);
