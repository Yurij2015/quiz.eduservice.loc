<html>
<head>
    <title>Тесты</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
</html>
<?php
error_reporting( 0 );
session_start();
if ( $hm == "" ) {
	$hm = ".";
}
if ( $hm2 == "" ) {
	$hm2 = ".";
}
require_once "$hm/admin/auth/config.php";
if ( ( $hostname == "" || $dbname == "" || $username == "" ) ) {

	echo "<div align='center' style='margin-top:20%;color:red;'><b>Необходимо настроить систему.</b></div>";
} else {
	$link = mysql_connect( "$hostname", "$username", "$password" );
	if ( $link ) {
		$dbcon = mysql_select_db( "$dbname", $link );
	}
	$quiz_staus  = 0;
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if ( isset( $_GET['logout'] ) ) {
		$_SESSION['catid'] = "";
		$_SESSION['uname'] = "";
		session_destroy();
		$bname = basename( $_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'] );
		echo "<script type='text/javascript'>window.location.href='./$bname';</script>";
	}

	if ( ( isset( $_SESSION['catid'] ) ) || ( isset( $_POST['catid'] ) && isset( $_POST['uname'] ) ) ) {
		if ( $_SESSION['catid'] == "" ) {
			$_SESSION['catid'] = $_POST['catid'];
		}
		if ( $_SESSION['uname'] == "" ) {
			$_SESSION['uname'] = $_POST['uname'];
		}
		$catid          = $_SESSION['catid'];
		$uname          = $_SESSION['uname'];
		$settings_query = mysql_query( "SELECT * FROM settings WHERE id=1 " );
		$settings_row   = mysql_fetch_assoc( $settings_query );
		$limit          = $settings_row['pagenum'];
		$time           = $settings_row['examtime'];
		$quiz_staus     = 1;


	} else {
		$uname = "<b>     Система тестирования пользователей     </b>";
	}
	?>

    <div class="top">
        <!-- top_con begins -->
        <div class="top_con">
            <ul class="top_con_ul_pos1">

                <li><span class="admin_name"><?php echo $uname; ?></span></li>
                <!--                <li><a href="admin/index.php" style="text-decoration: none; color: white"> Управление тестами</a></li>-->
                <!--                <li>Логин для админки - admin. Пароль - 123</li>-->

            </ul>

			<?php
			if ( $quiz_staus == 1 )
			{
			?>
            <ul class="top_con_ul_pos2">
                <li id='timee'>
                    <div id="hms"><?php echo $time; ?></div>
                </li>
                <li><a href="<?php echo $actual_link; ?>?logout=yes">Выход</a></li>
				<?php
				}
				?>
            </ul>


        </div>
        <!-- top_con ends -->

    </div>

	<?php

	echo "<div id='maindiv' class='frms clearfix'>";

	//$conut     = mysql_query( "SELECT * FROM quizresults WHERE name='$uname' and cat_id=$catid" );
	//$pconut    = mysql_num_rows( $conut );
	//echo "Количество ответов - $pconut";

	$conut  = mysql_query( "SELECT * FROM quizresults WHERE name='$uname' and cat_id=$catid" );
	$pconut = mysql_num_rows( $conut );
	if ( $pconut != 0 ) {
		echo "Вы уже проходили этот тест!<br>";
		//echo $pconut;
		echo "<hr style='width: 200px; float: left; color: #333;'>";
		echo "<br>";
		echo "<a href='$actual_link?logout=yes' style='border: 1px solid black; padding: 7px 10px 7px 10px; float:left; text-decoration: none; font-weight: bold; background: black; color: white;'>Назад</a>";
	} elseif ( $quiz_staus == 1 ) {
		echo "<div id='res_id' class='clearfix'><div class='clearfix'>";

		$limit_tag = "<br>";
		$query     = mysql_query( "SELECT * FROM quiz WHERE status='release' and catid=$catid" );
		$pcount    = mysql_num_rows( $query );
		$pages     = ceil( $pcount / $limit );


		echo "<input type='button' value='Назад' style='float:left;display:none;' id='top_prev' onclick=prevnext(0)>";

		echo "<input type='button' value='Далее' style='float:right;' id='top_next' onclick=prevnext(1)>";

		echo "</div><div class='clear'></div>";
		$lt = 1;
		$pn = 0;

		while ( $row = mysql_fetch_array( $query, MYSQL_ASSOC ) ) {

			$id   = $row['id'];
			$qns  = $row['question'];
			$ans  = $row['answer'];
			$opt1 = $row['opt1'];
			$opt2 = $row['opt2'];
			$opt3 = $row['opt3'];
			$opt4 = $row['opt4'];

			if ( $lt > $limit ) {
				$disp = "style='display:none;'";
			} else {
				$disp = "";
			}


			echo "<div class='news_poling disp_$pn'  $disp >";
			echo "<input type='hidden' id='ans_$id' value='$ans'>";
			echo "<div class='news_poling_top'><b>$lt</b>.$qns</div>";
			echo "<div class='news_poling_sele-ct'><form id='polingForm' method='post' action='survey-script/polling-result.php'>";
			echo "<div>
                        <input type='hidden' value='151' name='Qid'>
                        <fieldset class='radios' id='$id'>
                        <input type='radio' value='opt1' name='options_$id'  onclick=chkans(1,$id)>$opt1 $limit_tag
                        <input type='radio' value='opt2' name='options_$id' onclick=chkans(2,$id)>$opt2 $limit_tag";
			if ( $opt3 != '' ) {
				echo "<input type='radio' value='opt3' name='options_$id' onclick=chkans(3,$id)>$opt3 $limit_tag ";
			}
			if ( $opt4 != '' ) {
				echo "<input type='radio' value='opt4' name='options_$id' onclick=chkans(4,$id)>$opt4 $limit_tag ";
			}

			echo "</fieldset>
                        </div>";

			echo "</div>";

			echo "</div>";

			if ( $lt % $limit == 0 ) {
				$pn ++;
			}
			$lt ++;
		}

		echo "<input type='button' value='Посмотреть результат' onclick='results()' id='res_btn' style='display:none;'>";

		echo "<input type='button' value='Назад' style='float:left;display:none;' id='prev' onclick=prevnext(0)>";

		echo "<input type='button' value='Далее' style='float:right;' id='next' onclick=prevnext(1)>";
		echo "</div><div id='results' align='center' style='display:none;'>
     <div class='result' >
 <div class='row'>
      <div class='column'><b>Всего вопросов: </b></div>
      <div class='column'>$pcount</div>
  </div>
  <div class='row'>
      <div class='column'><b>Количество правильных ответов: </b></div>
      <div class='column'><span id='cans'></span></div>
  </div>
  <div class='row'>
   
      <div class='column'><b>Неправильные ответы: </b></div>
      <div class='column'><span id='wans'></span></div>
  </div>
    <div class='row'>
   
      <div class='column'><b>Общее количество отметок: </b></div>
      <div class='column'> <span id='marks'></span></div>
  </div>
  
  </div><div class='clear'></div>
   <div class='btn_style'><a href='$hm2/index.php?logout=yes'>Выход</a></div></div>
     ";


		?>
        <script type="text/javascript" src="<?php echo $hm2; ?>/admin/jquery.js"></script>
        <script type="text/javascript">
            var cresult = 0;
            var wresult = 0;
            var currpage = 0;
            var time_out;
            var prev = 0;
            var cstatus = 0;
            var uname = "<?php echo $uname;?>";
            var cat_id = "<?php echo $catid;?>";
            var total_pages = "<?php echo $pages;?>";
            var hm = "<?php echo $hm;?>";
            var hm2 = "<?php echo $hm2;?>";
            total_pages = total_pages - 1;
            var total_ques = "<?php echo $pcount;?>";

            function chkans(opt, ansid) {

                $ans = $('#ans_' + ansid).val()
                if ($ans == opt) {
                    cresult = parseInt(cresult) + 1;
                }
                else {

                    wresult = parseInt(wresult) + 1;

                }

            }

            function prevnext(opt) {

                $('.disp_' + currpage).css('display', 'none');

                if (opt == "1") {
                    currpage = parseInt(currpage) + 1;
                }
                else {
                    currpage = parseInt(currpage) - 1;
                }

                if (currpage >= total_pages) {
                    $('#next').css('display', 'none');
                    $('#top_next').css('display', 'none');

                    $('#res_btn').css('display', 'block');
                    cstatus = 1;

                }
                else {
                    $('#next').css('display', 'block');
                    $('#top_next').css('display', 'block');
                    $('#res_btn').css('display', 'none');
                }

                if (currpage <= 0) {
                    $('#prev').css('display', 'none');
                    $('#top_prev').css('display', 'none');
                }
                else {

                    $('#prev').css('display', 'block');
                    $('#top_prev').css('display', 'block');
                }
                if (cstatus == 1) {
                    $('#prev').css('display', 'none');
                    $('#top_prev').css('display', 'none');
                }
                $('.disp_' + currpage).css('display', 'block');
            }

            function results() {


                $tcans = cresult;
                $twans = wresult;
                $examtime = $('#hms').html();
                $('#cans').html($tcans);
                $('#wans').html($twans);
                $('#marks').html(cresult);
                $('#res_id').css('display', 'none');
                $('#results').css('display', 'block');
                $.ajax({//Make the Ajax Request
                    type: "POST",
                    url: hm2 + "/add-results.php",
                    data: {
                        name: uname,
                        catid: cat_id,
                        cans: $tcans,
                        wans: $twans,
                        examtime: $examtime,
                        hm: hm,
                        hm2: hm2
                    },
                    success: function (data) {

                        $('#error_msg').html("");
                        $('#msg').html(data);

                    }
                });

            }

            function count() {

                var startTime = document.getElementById('hms').innerHTML;
                var pieces = startTime.split(":");
                var time = new Date();
                time.setHours(pieces[0]);
                time.setMinutes(pieces[1]);
                time.setSeconds(pieces[2]);
                var timedif = new Date(time.valueOf() - 1000);
                var newtime = timedif.toTimeString().split(" ")[0];
                document.getElementById('hms').innerHTML = newtime;
                if (newtime == "00:00:00") {
                    clearTimeout(time_out);
                    $('#timee').css('display', 'none');
                    alert("Sorry!!your time is over..")
                    $('#next').css('display', 'none');
                    $('#top_next').css('display', 'none');

                    $('#res_btn').css('display', 'block');
                    cstatus = 1;
                    $('#prev').css('display', 'none');
                    $('#top_prev').css('display', 'none');
                    results();


                }
                time_out = setTimeout(count, 1000);
            }

            count();
        </script>

		<?php
	} else {
		echo "<div class='frms'>
                 <form name='quiz' action='' method='post'>
		  <label>Введите свое Имя и Фамилию: </label>
		  <input type='text' name='uname' value='' maxlength='20'> 
		 <label>Выберите категорию: </label>
		  <select name='catid'>";
		$cquery = mysql_query( "SELECT * FROM category WHERE status='release'" );
		if ( $cquery ) {

			while ( $crow = mysql_fetch_array( $cquery, MYSQL_ASSOC ) ) {
				$catid   = $crow['id'];
				$catname = $crow['category'];
				echo "<option value='$catid'>$catname</option>";
			}

		}
		echo "</select>
		  <input type='submit' value='Отправить'>
		 </form>
        </div>";
	}
	?>
    <link href="<?php echo $hm2; ?>/style.css" rel="stylesheet" type="text/css">
	<?php
}
?>