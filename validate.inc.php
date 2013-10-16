<?php
$con = mysql_connect("localhost", "root", "") or die('Could not connect to 
server');

mysql_select_db("mobi",$con) or die('Could not connect to database');
$userid = $_POST['userid'];
$password = $_POST['password'];
$query = "SELECT * from admin where userid = '$userid' and password = 
'$password'";
$result = mysql_query($query);

if (mysql_num_rows($result) == 0)
{
     echo "<h2>not in database: Sorry, your user account was not validated.</h2><br>\n";
}

else
{  
   $_SESSION['valid_user'] = $userid;
 echo "<table>
 <tr>
 <td>Customer name</td>
<td>Transaction Number</td>
</tr>";
   $query2 = mysql_query("SELECT * from admin");
   while($row = mysql_fetch_array($query2))
   {      
   echo '<tr><td>'.$row['userid'].'</td><td>'.$row['password'].'</td></tr>';
	 
	 }
  echo "</table>";
}

?>