<?php
error_reporting(0);
require_once "./auth/config.php";
$link = mysql_connect("$hostname","$username","$password");
if($link)
{
	$dbcon = mysql_select_db("$dbname",$link);
}
$status=$_POST['status'];
$id=$_POST['id'];
if($status=="delete" && $id!="")
{
    $query=mysql_query("delete from quiz where id='$id'");
}
else if($id!="")
{
 if($status=="release")    
    $query=mysql_query("update quiz set status='susbend' where id='$id'");
 else
   $query=mysql_query("update quiz set status='release' where id='$id'");
}
else
{
    echo "invalid data";
}
if($query)
{
    echo "success";
}
?>