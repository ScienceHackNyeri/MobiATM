<?php

########################################################
# Login information for the SMS Gateway
########################################################

$ozeki_user = "admin";
$ozeki_password = "admin";
$ozeki_url = "http://127.0.0.1:9501/api?";
$hostname="localhost";
$username="root";
$password="";

$con= mysql_connect($hostname, $username, $password) or die("unable to connect to the database");

$db=mysql_select_db("mobi",$con) or die("Database not found");
//$res="select phone from wananchi where location='$location'";
//$query = mysql_query($res);
########################################################
# Functions used to send the SMS message
########################################################
function httpRequest($url){
    $pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
    preg_match($pattern,$url,$args);
    $in = "";
    $fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
    if (!$fp) {
       return("$errstr ($errno)");
    } else {
        $out = "GET /$args[3] HTTP/1.1\r\n";
        $out .= "Host: $args[1]:$args[2]\r\n";
        $out .= "User-agent: Ozeki PHP client\r\n";
        $out .= "Accept: */*\r\n";
        $out .= "Connection: Close\r\n\r\n";

        fwrite($fp, $out);
        while (!feof($fp)) {
           $in.=fgets($fp, 128);
        }
    }
    fclose($fp);
    return($in);
}



function ozekiSend($phone, $msg, $debug=false){
      global $ozeki_user,$ozeki_password,$ozeki_url;

      $url = 'username='.$ozeki_user;
      $url.= '&password='.$ozeki_password;
      $url.= '&action=sendmessage';
      $url.= '&messagetype=SMS:TEXT';
      $url.= '&recipient='.urlencode($phone);
      $url.= '&messagedata='.urlencode($msg);

      $urltouse =  $ozeki_url.$url;
      if ($debug) { 
	  //header('Location: smssend.php');
	  
	  
	  }

      //Open the URL to send the message
      $response = httpRequest($urltouse);
      if ($debug) {
	  $resp ="Message sent";
           }

      return($response);
	  
}

########################################################
# GET data from sendsms.html
########################################################

//$phonenum = $_POST['recipient'];
$message = $_POST['message'];
$debug = true;
//while ($rows = mysql_fetch_array($query))
{
//echo $rows['phone_no']."\n";


ozekiSend($phone,$message,$debug);
}
?>