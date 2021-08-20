<?php

//Access: Authorized User & Admin
//Purpose: retrives all the contacts

require_once '../db_connect.php';

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$sql = "SELECT * FROM users WHERE emailUsers = :username";
$run = $dbh->prepare($sql);
$run->bindParam(':username', $username , PDO::PARAM_STR);
$run->execute();


if ($run->rowCount() > 0) {
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		    if(password_verify($password, $row['pwdUsers'])){
			    $fetch['userInfo'] = $row;
			    $fetch['userInfo']['pwdUsers'] = $password;
			    $fetch['error']['errorCode'] = "200";
		    }else{
		        $fetch['error']['errorCode'] = "204";
		    }
		}
	} else {
		$fetch['error']['errorCode'] = "204";
	}
	
$myfile = fopen("../log_file.txt", "w") or die("Unable to open file!");
fwrite($myfile, json_encode(password_verify($password, $row['pwdUsers'])));
fclose($myfile);	
	
echo json_encode($fetch);
