<?php

require_once '../db_connect.php';

$post = json_decode(file_get_contents('php://input'), true);

$sql = "UPDATE event set start_event=?, end_event=?, title=?, prod_name=?, perioxi=?, aitiologia_episkepsis=?, prod_phone=?, color=?, uid = ? where id=?";
					
$run = $dbh->prepare($sql);
$run->execute([$post['start_event'], $post['end_event'], $post['title'],$post['prod_name'],$post['perioxi'],$post['aitiologia_episkepsis'],$post['prod_phone'],$post['color'],$post['uid'],$post['id']]);

if ($run->rowCount() > 0) {
	$fetch['errorCode'] = "200";
} else {
	$fetch['errorCode'] = "201";
}

$myfile = fopen("../log_file.txt", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($fetch));
fclose($myfile);		
	
echo json_encode($fetch);