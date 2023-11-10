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
				

		$result = mysqli_query($link, "SELECT user.iduser, user.user, user.password, user.fname, user.lname, user.idward, user.position, user.email, user.tel1, user.tel2, user.sex, user.birthday, user.rdate, user.status, user.type, user.avatar, user.lat, user.lng, user.token, ward.wardname FROM user INNER JOIN ward ON user.idward=ward.idward ORDER BY iduser");

		if ($result) {

			while($row=mysqli_fetch_assoc($result)){
			$output[]=$row;

			}

			echo json_encode($output);

		}

	} else echo "Welcome Master UNG";
   
}


	mysqli_close($link);
?>