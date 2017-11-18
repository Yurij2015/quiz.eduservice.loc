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

$res2 = mysql_query( "SELECT * FROM quizresults order by id desc limit $start,10" );
echo "<div id='maindiv'>";

//echo $start;

$delcnt1 = mysql_num_rows( $res2 );
$tcount  = $delcnt1;
echo "<input type='hidden' value='$tcount' id='tcount'>";

echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          
          <th>Имя</th>
          <th>Категория</th>
          <th>Правильных ответов</th>
		  <th>Не правильных ответов</th>
		  <th>Отметок</th>
		  <th>Время на тест</th>
		  <th>Дата</th>
	 
        </tr>';
$xx = 0;
$d  = 0;

while ( $line = mysql_fetch_assoc( $res2 ) ) {
	$id = $line['id'];

	$name     = $line['name'];
	$catid    = $line['cat_id'];
	$res3     = mysql_query( "SELECT category FROM category where id='$catid'" );
	$crow     = mysql_fetch_assoc( $res3 );
	$cat_name = $crow['category'];

	$cans     = $line['correct_ans'];
	$wans     = $line['wrong_ans'];
	$marks    = $line['marks'];
	$examtime = $line['examtime'];

	$date = $line['datee'];

	echo "<tr id='row_$id'>";


	echo "<td>$name</td><td>$cat_name</td>
			<td>$cans</td><td>$wans</td><td>$marks</td><td>$examtime</td><td>$date</td>
			
			
			</tr>";
	$xx ++;
	$d ++;
}


echo "</table></div>";

?>

