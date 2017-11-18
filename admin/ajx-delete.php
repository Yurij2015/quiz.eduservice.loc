<?php
require_once "auth/config.php";

$link = mysql_connect($hostname, $username,$password);
if($link)
{
	$dbcon = mysql_select_db($dbname,$link);
}
$idd=$_POST['id'];
$tabnam=$_POST['tabnam'];

if($tabnam=='filter'){
   $delname = $idd;   
   $result = mysql_query("delete from filter where word='$delname'",$link);
   
     if($result)
       echo "<div align='center'><font color=Green><b>$delname Deleted</b></font></div>";
 }
 else if($tabnam=='ip'){
   $delname = $idd;   
   $result = mysql_query("delete from filter where ip='$delname'",$link);
   
     if($result)
       echo "<div align='center'><font color=Green><b>$delname Deleted</b></font></div>";
 }
 else
 {
       $result = mysql_query("delete from $tabnam where id='$idd'",$link);
     if($result)
       echo "<div align='center'><font color=Green><b>$delname Deleted</b></font></div>";
    
 }
 ?>