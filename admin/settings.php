<?php
error_reporting( 0 );
include "authheader.php";
if ( $block != true ) {
	require_once "./auth/config.php";
	$link = mysql_connect( "$hostname", "$username", "$password" );
	if ( $link ) {
		$dbcon = mysql_select_db( "$dbname", $link );
	}
	include "heade.php";
	?>
    <script type='text/javascript'>
        var pp = 1;
        $(document).ready(function () {
            $('#m5').html("<span class='curr_mnu'>Настройки</span>")

        });

        function submit_settings() {
            $pnum = $('#num').val();
            $etime = $('#etime').val();


            $.ajax({//Make the Ajax Request
                type: "POST",
                url: "./ajx-update-settings.php",
                data: {pnum: $pnum, etime: $etime},
                success: function (data) {


                    $('#msg').html("<font color='green'>" + data + "</font>");

                    setTimeout(function () {

                        window.location.href = "./settings.php";

                    }, 1000);
                }
            });

        }
    </script>
	<?php
	$res = mysql_query( "SELECT * FROM settings where id='1'" );
	if ( $res ) {
		$row          = mysql_fetch_assoc( $res );
		$pnum         = $row['pagenum'];
		$examtime     = $row['examtime'];
		$examtimearr  = explode( ":", "$examtime" );
		$examtime_val = $examtimearr[0] . ":" . $examtimearr[1];
	}

	echo '<div class="form"><div id="error_msg" class="errortext"></div><div id="msg"></div>';

	echo "<form name=de method='post' action=''>";

	echo "<div class='form_con'> <div class='form_element lable'> Количество вопросов отображаемых на странице: </div><div class='form_element'><select name='num' id='num' class='selectbox'>";
	echo "<option value='$pnum'>$pnum</option>";
	for ( $i = 1; $i <= 10; $i ++ ) {
		echo "<option value='$i'>$i</option>";

	}
	echo "</select></div>  <div class='clear'></div><br><div class='form_element lable'> Время на тест: </div><div class='form_element'><select name='etime' id='etime' class='selectbox'>";
	echo "<option value='$examtime'>$examtime_val</option>";
	echo '
    <option value="00:30:00">00:30</option>
     <option value="00:45:00">00:45</option>
    <option value="01:00:00">01:00</option>
    <option value="01:15:00">01:15</option>
    <option value="01:45:00">01:45</option>
    <option value="02:00:00">02:00</option>
    <option value="02:15:00">02:15</option>
    <option value="02:30:00">02:30</option>
     <option value="02:45:00">02:45</option>
     <option value="03:00:00">03:00</option>
      <option value="03:30:00">03:30</option>
      <option value="04:00:00">04:00</option>
        ';
	echo "</select></div> <div class='clear'></div><br> <span style='float:left;'>";

	echo "<input name=submit type='button' value=Сохранить class='form_button' onclick='submit_settings()'>";


	echo "</span></form></div>";

}
?>


