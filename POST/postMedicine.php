<?php

require_once '../db_connect.php';

$post = json_decode(file_get_contents('php://input'), true);

$sql = "INSERT INTO medicines (medName, drastikiOusia, medCompany, anamoniBooeidi, anamoniAiges, anamoniProbata, anamoniXoiroi, anamoniIndornithes, anamoniMelisses, anamoniKreas, anamoniGala, anamoniAuga, anamoniMeli, medDosologia, medXronosTherapias, registerMed, uid)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
					
$run = $dbh->prepare($sql);
$run->execute([$post['medName'], $post['drastikiOusia'], $post['medCompany'],$post['anamoniBooeidi'],$post['anamoniAiges'],$post['anamoniProbata'],$post['anamoniXoiroi'],$post['anamoniIndornithes'],$post['anamoniMelisses'],$post['anamoniKreas'],$post['anamoniGala'],$post['anamoniAuga'],$post['anamoniMeli'],$post['medDosologia'],$post['medXronosTherapias'],$post['uid']]);

if ($run->rowCount() > 0) {
	$fetch['errorCode'] = "200";
} else {
	$fetch['errorCode'] = "201";
}

$myfile = fopen("../log_file.txt", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($fetch));
fclose($myfile);		
	
echo json_encode($fetch);