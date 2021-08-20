<?php

require_once '../db_connect.php';

$uid = $_POST['uid'];
$message = $_POST['toDoText'];
$isDone = 0;

$sql = "INSERT INTO `todo`(`uid`, `item`, `isDone`) VALUES (:uid, :message, :isDone)";
$run = $dbh->prepare($sql);
$run->bindParam(':uid',$uid,PDO::PARAM_INT);
$run->bindParam(':message',$message,PDO::PARAM_STR);
$run->bindParam(':isDone',$isDone,PDO::PARAM_STR);
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
