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
    $token = $_GET['sendtoken'];
    $title = $_GET['title'];
    $body = $_GET['body'];
    $serverKey = $_GET['serverKey'];	
	$url = "https://fcm.googleapis.com/fcm/send";
    echo $token;
    //$token bilgisi cihazın bilgisidir 
    $serverKey = $serverKey;
    $notification = array('title' => $title , 'body' =>  $body, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('registration_ids' => [$token], 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    //curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    //curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }

    //"multicast_id":2867820107942227442,"success":1,"failure":0,"canonical_ids":0,"results":[{"message_id":"1584799000714742"
    $result = json_decode($response, true);
    return $result;

    curl_close($ch);
    //curl_close($response);
    //header('Content-type: application/json');
    //header('Content-type: text/html; charset=UTF-8');
    //header('content-type application/json charset=utf-8')
    //exit;

	} else echo "Welcome Master UNG";
   
}
?>