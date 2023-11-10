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
                $avatar  = $_GET['avatar'];
                $substrnamefolder  = 6;
                $avatar = substr($avatar,$substrnamefolder);
                    if ($avatar == 'avatar/com.png') {
                    } else {
                        unlink($avatar);
                    }
                } else echo "Welcome Master UNG";
        }