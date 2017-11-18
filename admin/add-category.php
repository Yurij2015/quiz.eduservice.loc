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
            $('#m3').html("<span class='curr_mnu'>Добавить категорию</span>")

        });

        function submit_category() {
            $catname = $('#catname').val();
            $catstatus = $('#catstatus').val();


            if ($catname == "") {
                $('#error_msg').html("Название категории не заполнено..")
            }

            else {
                $.ajax({//Make the Ajax Request
                    type: "POST",
                    url: "./ajx-addcategory.php",
                    data: {catname: $catname, catstatus: $catstatus},
                    success: function (data) {

                        $('#error_msg').html("");
                        $('#msg').html(data);

                        setTimeout(function () {

                            window.location.href = "./add-category.php";

                        }, 1000);
                    }
                });
            }
        }
    </script>
	<?php


	echo '<div class="form"><div id="error_msg" class="errortext"></div><div id="msg"></div>';

	echo "<form name=de method='post' action=''>";
	echo "<div class='form_con'> <div class='form_element lable'>Название категории</div><div class='form_element'><input type=text name=catname id='catname' value=''  class='textbox'></div></div>";

	echo "<div class='form_con'> <div class='form_element lable'> Статус: </div><div class='form_element'><select name='catstatus' id='catstatus' class='selectbox'><option value='release'>Активна</option><option value='susbend'>Не активна</option></select></div>";


	echo " <span style='float:left;'>";

	echo "<input name=submit type='button' value=Сохранить class='form_button' onclick='submit_category()'>";


	echo "</span></form></div>";

}
?>


