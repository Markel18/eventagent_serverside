<?php

require_once '../db_connect.php';

$isDone = $_REQUEST['isDone'];
$item = $_REQUEST['item'];
$IDItem = $_REQUEST['itemId'];
$uId = $_REQUEST['id'];

$sql = "UPDATE todo SET isDone=:isDone, item=:item WHERE IDItem=:IDItem AND uid = :uId";
$run= $dbh->prepare($sql);
$run->bindParam(':isDone', $isDone , PDO::PARAM_INT);
$run->bindParam(':IDItem', $IDItem , PDO::PARAM_INT);
$run->bindParam(':uId', $uId , PDO::PARAM_INT);
$run->bindParam(':item', $item , PDO::PARAM_STR);
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