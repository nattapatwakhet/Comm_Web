<?php
	header("Access-Control-Allow-Origin: *");
    error_reporting(0);
    error_reporting(E_ERROR | E_PARSE);
    header("content-type:text/javascript;charset=utf-8");
    $link = mysqli_connect('localhost', 'master', '0864379152', "comm");
    if (!$link) {
        // die("Connection failed: " . mysqli_connect_error());
        echo 'false';
      }
      echo 'true';
?>