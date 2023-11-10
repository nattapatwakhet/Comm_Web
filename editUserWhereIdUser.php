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
		$user = $_GET['user'];
		$password = $_GET['password'];
		$fname = $_GET['fname'];
		$lname = $_GET['lname'];
		$idward = $_GET['idward'];
		$position = $_GET['position'];
		$email = $_GET['email'];	
		$tel1 = $_GET['tel1'];
		$tel2 = $_GET['tel2'];
		$sex = $_GET['sex'];
		$birthday = $_GET['birthday'];
		$status = $_GET['status'];
		$type = $_GET['type'];
		$avatar = $_GET['avatar'];
		$lat = $_GET['lat'];
		$lng = $_GET['lng'];
		date_default_timezone_set('asia/bangkok');
        $rdate = date('Y-m-d H:i:s');			
		$sql = "UPDATE `user` SET `user` = '$user', `password` = '$password', `fname` = '$fname', `lname` = '$lname', `idward` = '$idward', `position` = '$position', `email` = '$email', `tel1` = '$tel1', `tel2` = '$tel2', `sex` = '$sex', `birthday` = '$birthday', `status` = '$status', `type` = '$type', `avatar` = '$avatar', `lat` = '$lat', `lng` = '$lng', `rdate` = '$rdate' WHERE iduser = '$iduser'";
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