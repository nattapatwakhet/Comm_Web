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
				
		$status = $_GET['status'];
        $date = $_GET['date'];

		$result = mysqli_query($link, "SELECT COUNT(status) as sumstatus FROM report WHERE status = '$status' AND stime BETWEEN '$date 00:00:00' AND '$date 23:59:59'");

		if ($result) {

			while($row=mysqli_fetch_assoc($result)){
			$output=$row['sumstatus'];

			}

			echo json_encode($output);

		}

	} else echo "Welcome Master UNG";
   
}


	mysqli_close($link);
?>