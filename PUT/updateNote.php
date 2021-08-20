<?php

require_once '../db_connect.php';

$message = $_REQUEST['message'];
$commentID = $_REQUEST['commentID'];
$uId = $_REQUEST['id'];

$sql = "UPDATE comments SET message=:message WHERE commentID=:commentID AND uid = :uId";
$run= $dbh->prepare($sql);
$run->bindParam(':commentID', $commentID , PDO::PARAM_INT);
$run->bindParam(':uId', $uId , PDO::PARAM_INT);
$run->bindParam(':message', $message , PDO::PARAM_STR);
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