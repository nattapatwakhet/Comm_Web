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
                                        
                $report  = $_GET['report'];
                $substrnamefile  = $_GET['substrnamefile'];
                $substrnamefile  = 6;
                $report = substr($report,$substrnamefile);
                    if ($report == 'picturereport/com.png') {
                    } else {
                        unlink($report);
                    }
                } else echo "Welcome Master UNG";
           
        }