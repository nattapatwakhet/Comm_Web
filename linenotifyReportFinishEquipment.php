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
                    
            $did  = $_GET['did'];
            $header = $_GET['status'];
            $department = $_GET['department'];
            $tel = $_GET['tel'];
            $dname = $_GET['dname'];
            $id = $_GET['id'];
            $detail = $_GET['detail'];
            $fname = $_GET['fname'];
            date_default_timezone_set('asia/bangkok');
            $ftime = date('Y-m-d H:i:s');
            $stime = $_GET['stime'];
            $rtime = $_GET['rtime'];
            $rname = $_GET['rname'];
            $detaile = $_GET['detaile'];
            $ename = $_GET['ename'];
            $lat = $_GET['lat'];
            $lng = $_GET['lng'];
            $ncom = $_GET['ncom'];
            $tokenline  = $_GET['tokenline'];
       
        }
    }
    
	$token = $tokenline; // LINE Token
    //Message
    $header = 'ซ่อมเสร็จแล้ว';
    $mymessage = 
    $header .
    "\n" .
    'หมายเลขเครื่อง : ' .
    $did .
    "\n" .
    'ชื่ออุปกรณ์ : ' .
    $dname .
    "\n" .
    'เลขพัสดุ/เลขครุภัณฑ์ : ' .
    $id .
    "\n" .
    'ip/ชื่อ คอม : ' .
    $ncom .
    "\n" .
    'แผนก/ห้อง/หน่วยงาน	: ' .
    $department .
    "\n" .
    'หมายเลขโทรศัพท์ที่ติดต่อ : ' .
    $tel .
    "\n" .
    'อาการ : ' .
    $detail .
    "\n" .
    'วิธีแก้ไข : ' .
    $detaile .
    "\n" .
    'ชื่อผู้แจ้ง : ' .
    $fname .
    "\n" .
    'เวลาแจ้ง : ' .
    $stime .
    "\n" .
    'ชื่อผู้รับแจ้ง : ' .
    $rname .
    "\n" .
    'เวลารับแจ้ง : ' .
    $rtime .
    "\n" .
    'ชื่อผู้แก้ไข : ' .
    $ename .
    "\n" .
    'เวลาแก้ไขเสร็จ : ' .
    $ftime .
    "\n" .
    'พิกัด : ' .
    'https://www.google.com/maps/@' .
    $lat .
    ',' .
    $lng .
    ',15z' .
    "\n"; //Set new line with '\n'
    // $picturereport = substr($picturereport,34);
    // $imageFile = new CURLFILE($picturereport); // Local Image file Path
    //$sticker_package_id = '2';  // Package ID sticker
    //$sticker_id = '34';    // ID sticker
    // if ($picturereport == 'picturereport/com.png') {
    //     $data = array (
    //         'message' => $mymessage
    //       );
    // } else {
        $data = array (
            'message' => $mymessage
            // 'imageFile' => $imageFile,
            //'stickerPackageId' => $sticker_package_id,
            //'stickerId' => $sticker_id
          );
    // }
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