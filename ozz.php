<?php
/*include(db.php);*/
include('m.php');
$sender = $_GET['sender'];
$message = $_GET['msgdata'];

echo $sender;
echo $message;


/*//$sender="+254704103356";
//$message="mangoes / nyeri";
	$db_host  = "localhost";
 // PHP variable to store the username
 $db_uid  = "root";
 // PHP variable to store the password
 $db_pass = "";
 // PHP variable to store the Database name
 $db_name  = "mobi";*/
 $connect = mysql_connect('localhost', 'root' , '') or die('No database established');
mysql_select_db('mobi',$connect);
 $parts = explode("#", $message);

 $message = $parts['0'];
$message1 = $parts['1'];
 $message2 = $parts['2'];
  $message3 = $parts['3'];
  $message4 = $parts['4'];
  
//$insert_user=mysql_query("INSERT INTO bdetails (name) VALUES ('$message')");
	
	
   $queryuser=mysql_query("SELECT * FROM bdetails WHERE bank_name='$message' and atm_pin='$message3'");
$checkuser=mysql_num_rows($queryuser);
if($checkuser != 0)
{
	$b1=mysql_query("SELECT balance FROM bdetails WHERE bank_name='$message' and acc_no='$message2'");
	$b2=mysql_query("SELECT balance FROM bdetails WHERE bank_name='$message1'");
	$b3=$message4;

	if ($b3>=($b1+200)) {

		# code...
		$b4=$b1-$b3;
		$b5=$b2+$b3;
		mysql_query("UPDATE bdetails SET balance='$b4' WHERE bank_name='$message'");
		mysql_query("UPDATE bdetails SET balance='$b5' WHERE bank_name='$message1'");


	}
	else {
		$message="you dont have enough credit to withdraw '$message4'";

		ozekiSend($sender,$message,$debug);

	}
	
	}
	else{
	echo "information not in database";}

	


	?>
