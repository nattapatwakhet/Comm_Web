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

date_default_timezone_set('asia/bangkok');
$rtime = date('Y-m-d H:i:s');

if (isset($_GET)) {
	if ($_GET['isAdd'] == 'true') {
			
		$oID = $_GET['oID'];		
		$status = $_GET['status'];
		$rname = $_GET['rname'];
		$stime = $_GET['stime'];	
							
		$sql = "UPDATE `report` SET  `status` = '$status', `rname` = '$rname', `rtime` = '$rtime' WHERE oID = '$oID' AND stime = '$stime'";

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