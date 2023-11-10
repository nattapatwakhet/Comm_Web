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
		$iduser = $_GET['iduser'];		
		$token = $_GET['token'];
		date_default_timezone_set('asia/bangkok');
        $rdate = date('Y-m-d H:i:s');
		$status = '1';				
		$sql = "UPDATE `user` SET `token` = '$token', `rdate` = '$rdate', `status` = '$status' WHERE iduser = '$iduser'";
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