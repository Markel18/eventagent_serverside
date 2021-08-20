<?php

//Access: Authorized User & Admin
//Purpose: retrives all the contacts

require_once '../db_connect.php';

$sql = "SELECT MAX(userPrescID)+1 AS userPrescID FROM suntagografisi";
$run = $dbh->prepare($sql);
$run->execute();

if ($run->rowCount() > 0) {
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$fetch['producers'][] = $row;
			$fetch['error']['error_code'] = "200";
		}
	} else {
		$fetch['error']['error_code'] = "204";
	}
echo json_encode($fetch);
