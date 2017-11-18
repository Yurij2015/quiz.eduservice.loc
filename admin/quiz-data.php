<?php
error_reporting( 0 );
require_once "./auth/config.php";
$link = mysql_connect( "$hostname", "$username", "$password" );
if ( $link ) {
	$dbcon = mysql_select_db( "$dbname", $link );
}
$uidd  = $_SERVER['REQUEST_URI'];
$host1 = $_SERVER['SERVER_NAME'];
$uidd  = "http://$host1$uidd";
// echo $uidd;


$page = $_REQUEST['page'];

$start = ( $page ) * 10;

$res2 = mysql_query( "SELECT * FROM quiz order by id desc limit $start,10" );
echo "<div id='maindiv'>";

//echo $start;

$delcnt1 = mysql_num_rows( $res2 );
$tcount  = $delcnt1;
echo "<input type='hidden' value='$tcount' id='tcount'>";

echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          
          <th>Вопрос</th>
          <th>Номер ответа</th>
          <th>Ответ 1</th>
		  <th>Ответ 2</th>
		  <th>Ответ 3</th>
		  <th>Ответ 4</th>
		  <th>Статус</th>
		  <th>Удалить</th>
	  <!--<th>Edit</th>-->
	 
        </tr>';
$xx = 0;
$d  = 0;

while ( $line = mysql_fetch_assoc( $res2 ) ) {
	$id = $line['id'];

	$qns  = $line['question'];
	$ans  = $line['answer'];
	$opt1 = $line['opt1'];
	$opt2 = $line['opt2'];
	$opt3 = $line['opt3'];
	$opt4 = $line['opt4'];

	$date   = $line['datee'];
	$status = $line['status'];
	if ( $status == 'susbend' ) {
		$stle_bg = "style='background-color:#C16161;color:#fff;text-shadow:none;'";
	} else {
		$stle_bg = "";
	}
	echo "<tr id='row_$id'>";


	echo "<td>$qns</td><td>Opt $ans</td>
			<td>$opt1</td>
			<td>$opt2</td>
			<td>$opt3</td>
			<td>$opt4</td>
			<td $stle_bg id='status_$id'><a href='javascript:changestatus(\"$status\",$id);' id='href_status_$id'> $status</a></td>
			
			<td> <a href='javascript:changestatus(\"delete\",$id);'>Удалить</a></td>
			<!--<td><a href='./add-question.php?eid=$id'>Edit</a></td>-->
			</tr>";
	$xx ++;
	$d ++;
}


echo "</table></div>";

?>

