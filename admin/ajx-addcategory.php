<?php
error_reporting(0);
require_once "./auth/config.php";
$link = mysql_connect("$hostname","$username","$password");
if($link)
{
	$dbcon = mysql_select_db("$dbname",$link);
}
$catname=trim($_POST['catname']);
$catstatus=trim($_POST['catstatus']);

if($catname!="" && $catstatus!="")
{
  $chkduplicate=  mysql_query("select id from category where category like '$catname' ");
  $dup_count= mysql_num_rows($chkduplicate);
  if($dup_count==0)
  {
    $query =  mysql_query("INSERT into category set category='$catname',status='$catstatus'");
      if($query)
    {
       echo "<font color='green'>Your category name added sucessfully..</font>";    
    }
    else
     {
         echo "<font color='red'>Your category name not added</font>";        
     }
  }
 else
  {
	echo "<font color='red'>Catagory name is already added</font>";        
  }
 
}
else
 {
    echo "<font color='red'>Invalid category name </font>";  
 }


?>