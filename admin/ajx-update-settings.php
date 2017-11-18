<?php
error_reporting(0);
require_once "./auth/config.php";
$link = mysql_connect("$hostname","$username","$password");
if($link)
{
	$dbcon = mysql_select_db("$dbname",$link);
}

$etime=$_POST['etime'];
$pnum=$_POST['pnum'];
if($etime=="" || $pnum=="")
{
	$msg="Invalid data..";
}
else
{
    $query=mysql_query("update settings set pagenum='$pnum' ,examtime='$etime' where id='1'");
    if($query)
    {
	$msg="Updated Sucessfully...";
    }
}

    echo $msg;

?>