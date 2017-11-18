<?php
error_reporting(0);
$un = $_POST['usern'];
$pw = $_POST['passw'];
//echo $un;

$pw1=md5($pw);

$link = mysql_connect($hostname, $username,$password);

if($link)
{

 	$dbcon = mysql_select_db("$dbname",$link);

	if($dbcon)
	{
		
	    	$result = mysql_query("select password from hioxpm where username='$un'",$link);
$login_msg="";
	 	if (!$result)
		{
		    $login_msg="Unable to get authentication values.";
		    
		    $block = true;
		}
		else
		{
			if($pas=mysql_fetch_row($result))
			{
				$dbpas = $pas[0];
			}	
			@mysql_free_result($pas);

	
			if($pw1 == $dbpas)
			{
			   session_start();
			   //session_register("auth");
			   $_SESSION['HRS'] = "passed";
			   $block = false;
			echo "<script type='text/javascript'>window.location.href='./index.php';</script>";
			}
			else
			{
				 $login_msg= "Authentication Failed - ENTER correct username and password.<br><br>
				           To reset the password - delete the table hioxpm in your database and 
				reinstall using install.php</div>";
				 include "authlogin.php";
				 $block = true;
			}
		}
		echo "<div class='clear'></div><br><br><font color='red'>".$login_msg."</font>";
	}
	else
	{
		$vv = false;	
	}
}
else
{
	$vv = false;
}

if($vv === false)
{
  "<div class='form' style='margin:25px;border:1px solid #ddd;padding:10px;'>";
 echo "<form method=POST action=$PHP_SELF>";
 echo "<input type=hidden name=type value=changedb>";
 echo "<div class='errortext'>Unable to connect to the database.<br>
	Please check your database entries  </div><br><input type=submit value='dbentries' class='form_button' style='float:left;'><div style='clear:both;'></div>";
 echo "</form>";
echo(" </div>");

$block = true;
}

?>
