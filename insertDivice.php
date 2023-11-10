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
		$dname = $_GET['devicename'];
		$status = $_GET['status'];
		$idward = $_GET['idward'];
		$rname = $_GET['savename'];
		$id = $_GET['parcelnumber'];
		$ncom = $_GET['comname'];
        $edate = date("Y-m-d H:i:s");//$_GET['0000-00-00 00:00:00'];				
		$sql = "INSERT INTO `device`(`did`, `status`, `dname`, `id`, `idward`, `edate`, `ncom`, `rname`) VALUES (Null, '$status', '$dname', '$id', '$idward', '$edate', '$ncom', '$rname')";
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