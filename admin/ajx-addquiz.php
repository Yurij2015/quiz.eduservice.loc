<?php
error_reporting(0);
require_once "./auth/config.php";
$link = mysql_connect("$hostname","$username","$password");
if($link)
{
	$dbcon = mysql_select_db("$dbname",$link);
}
$ques=trim($_POST['ques']);
$catid=trim($_POST['catid']);
$opt1=trim($_POST['opt1']);
$opt2=trim($_POST['opt2']);
$opt3=trim($_POST['opt3']);
$opt4=trim($_POST['opt4']);
$ans=trim($_POST['ans']);
$imptid=trim($_POST['imptid']);
if($imptid=="add")
{
$dat=date('Y-m-d');
if($ques!="" && $opt1!="" && $opt2!="" && $ans!="" && $catid!="")
{
    $query =  mysql_query("INSERT into quiz set catid='$catid' , question='$ques',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',answer='$ans',datee='$dat',status='release'");
   // echo "INSERT into quiz set catid='$catid' , question='$ques',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',ans='$ans',date='$dat'";
    if($query)
    {
       echo "<font color='green'>Вопрос успешно добавлен..</font>";
    }
    else
     {
         echo "<font color='red'>Вопрос не добавлен</font>";
     }
}
else
 {
    echo "<font color='red'>Ошибка вопроса и настроек </font>";
 }
}
else
{

    if($imptid!="")
    {
        $query =  mysql_query("update quiz set catid='$catid' , question='$ques',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',answer='$ans',datee='$dat' where id='$imptid'");
	if($query)
	    echo "<font color='green'>Вопрос обновлен успешно..</font>";
	else
	    echo "<font color='red'>Ошибка обновления..</font>";
    }
}
?>