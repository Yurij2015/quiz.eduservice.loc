<?php
error_reporting(0);
include "config.php";
$host="localhost";
$uname="root";
$pwd="";
$dbname="hscripts";

$link = mysql_connect($host, $uname,$pwd) or die ("Could not connect");

mysql_select_db($dbname,$link);
$action=$_POST['idd']; 
if(isset($_POST['idd']))
  {
   $id = $_POST['idd'];
   $id = mysql_escape_String($id);
   $delquery=mysql_query("delete from survey where id=$id") or die(mysql_error());
   $qry = mysql_query("delete from rating where id=$id") or die(mysql_error());
   echo "Record deleted";
  }