<?php
	include 'connected.php';
	header("Access-Control-Allow-Origin: *");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    
    exit;
}

if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
	}

if (isset($_GET)) {
	if ($_GET['isAdd'] == 'true') {
				
		$idward = $_GET['department'];

		$result = mysqli_query($link, "SELECT COUNT(ward.idward) as sumdepartment FROM device JOIN ward ON device.idward=ward.idward JOIN report ON device.did=report.did WHERE ward.idward = '$idward'");

		if ($result) {

			while($row=mysqli_fetch_assoc($result)){
			$output=$row['sumdepartment'];

			}

			echo json_encode($output);

		}

	} else echo "Welcome Master UNG";
   
}


	mysqli_close($link);
?>