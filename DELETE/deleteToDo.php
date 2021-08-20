<?php

require_once '../db_connect.php';

$uid = $_REQUEST['id'];
$iId = $_REQUEST['itemId'];

$sql = "DELETE FROM todo where uid=:uid and IDItem=:iId";
$run = $dbh->prepare($sql);
$run->bindParam(':uid', $uid , PDO::PARAM_INT);
$run->bindParam(':iId', $iId , PDO::PARAM_INT);
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