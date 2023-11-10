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
		$result = mysqli_query($link, "SELECT report.oid, report.status, report.tel, report.detail, report.fname, report.stime, report.rtime, report.ftime, report.rname, report.detaile, report.ename, report.lat, report.lng, report.tokenreport, report.did, device.dname, device.id, device.idward, device.ncom, ward.wardname FROM report INNER JOIN device ON report.did=device.did INNER JOIN ward ON device.idward=ward.idward ORDER BY stime DESC");
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