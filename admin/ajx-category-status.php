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
$catname=$_POST['catname'];
$catstatus=$_POST['catstatus'];
if($id=="")
{
	$msg="Invalid data..";
}
else if($status=="delete")
{
    $query=mysql_query("delete from category where id='$id'");
    if($query)
    {
	$msg="Deleted Sucessfully...";
    }
}
else if($status=="update")
{
    $query=mysql_query("update category set category='$catname', status='$catstatus' where id='$id'");
    
     if($query)
    {
	$msg="Updated Sucessfully...";
    }
 
}
else
{
   $msg= "invalid data";
}

    echo $msg;

?>