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
                    
            $did = $_GET['did'];
            $devicename = $_GET['devicename'];
            $agencydepartmentworkgroup = $_GET['agencydepartmentworkgroup'];
            $informername = $_GET['informername'];
            $contactphonenumber = $_GET['contactphonenumber'];
            $parcelnumber = $_GET['parcelnumber'];
            $symptom = $_GET['symptom'];
            $header = $_GET['status'];
            $lat = $_GET['lat'];
            $lng = $_GET['lng'];
            $picturereport = $_GET['report'];
            $ncom = $_GET['comname'];
            date_default_timezone_set('asia/bangkok');
            $stime = date('Y-m-d H:i:s');
            $substrnamefile  = $_GET['substrnamefile'];
            $substrnamefile  = 6;
            $tokenline  = $_GET['tokenline'];
        }
    }
    
	$token = $tokenline; // LINE Token
    //Message
    $header = 'แจ้งซ่อม';
    $mymessage = 
    $header .
    "\n" .
    'หมายเลขเครื่อง : ' .
    $did .
    "\n" .
    'ชื่ออุปกรณ์ : ' .
    $devicename .
    "\n" .
    'เลขพัสดุ/เลขครุภัณฑ์ : ' .
    $parcelnumber .
    "\n" .
    'ip/ชื่อ คอม : ' .
    $ncom .
    "\n" .
    'แผนก/ห้อง/หน่วยงาน	: ' .
    $agencydepartmentworkgroup .
    "\n" .
    'หมายเลขโทรศัพท์ที่ติดต่อ : ' .
    $contactphonenumber .
    "\n" .
    'อาการ : ' .
    $symptom .
    "\n" .
    'ชื่อผู้แจ้ง : ' .
    $informername .
    "\n" .
    'เวลาแจ้ง : ' .
    $stime .
    "\n" .
    'พิกัด : ' .
    'https://www.google.com/maps/@' .
    $lat .
    ',' .
    $lng .
    ',15z' .
    "\n"; //Set new line with '\n'
    $picturereport = substr($picturereport,$substrnamefile);
    $imageFile = new CURLFILE($picturereport); // Local Image file Path
    //$sticker_package_id = '2';  // Package ID sticker
    //$sticker_id = '34';    // ID sticker
    if ($picturereport == 'picturereport/com.png') {
        $data = array (
            'message' => $mymessage
          );
    } else {
        $data = array (
            'message' => $mymessage,
            'imageFile' => $imageFile,
            //'stickerPackageId' => $sticker_package_id,
            //'stickerId' => $sticker_id
          );
    }
      $chOne = curl_init();
      curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
      curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt( $chOne, CURLOPT_POST, 1);
      curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data);
      curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
      $headers = array( 'Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$token, );
      curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
      curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec( $chOne );
      //Check error
      if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
      else { $result_ = json_decode($result, true);
      echo "status : ".$result_['status']; echo "message : ". $result_['message']; 
      }
      //Close connection
      curl_close( $chOne );
?>