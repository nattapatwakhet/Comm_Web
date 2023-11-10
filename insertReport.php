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
				
		$did  = $_GET['did'];
		$status = $_GET['status'];
		$department = $_GET['agencydepartmentworkgroup'];
		$tel = $_GET['contactphonenumber'];
		$dname = $_GET['devicename'];
		$id = $_GET['parcelnumber'];
		$detail = $_GET['symptom'];
		$fname = $_GET['informername'];
        $rtime = date("Y-m-d H:i:s");//$_GET['0000-00-00 00:00:00'];	
        $ftime = date("Y-m-d H:i:s");//$_GET['0000-00-00 00:00:00'];	
		$lat = $_GET['lat'];
		$lng = $_GET['lng'];
		$ncom = $_GET['comname'];
		$tokenreport = $_GET['tokenMeDivice'];
							
		$sql = "INSERT INTO `report`(`status`, `tel`, `detail`, `fname`, `rtime`, `ftime`, `lat`, `lng`, `tokenreport`, `did`) VALUES ('$status', '$tel', '$detail', '$fname', '$rtime', '$ftime', '$lat', '$lng', '$tokenreport', '$did')";

		$result = mysqli_query($link, $sql);

		if ($result) {
			echo "true";
		} else {
			echo "false";
		}

	} else echo "Welcome Master UNG";
   
}
	mysqli_close($link);
?>