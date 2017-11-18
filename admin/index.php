<?php
error_reporting( 0 );
include "authheader.php";
if ( $block != true ) {
	require_once "auth/config.php";

	include "heade.php";
	?>

    <script type="text/javascript">
        var chk_id = '';

        $(document).ready(function () {
            $('#m1').html("<span class='curr_mnu'>Список вопросов</span>");

            function showLoader() {

                $('.search-background').fadeIn(200);
            }

            function hideLoader() {

                $('.search-background').fadeOut(200);
            };

            $("#paging_button li").click(function () {

                showLoader();

                $("#paging_button li").css({'background-color': ''});
                $(this).css({'background-color': '#006699'});

                $("#content").load("quiz-data.php?page=" + this.id, hideLoader);

                return false;
            });

            $("#1").css({'background-color': '#006699'});
            showLoader();
            $("#content").load("quiz-data.php?page=0", hideLoader);

        });

        function changestatus(statuss, idd) {
            status_msg = "delete";
            if (statuss != "delete") {

                statuss = $('#href_status_' + idd).html();
                if (statuss == "susbend") {
                    status_msg = "release"
                }
                else {
                    status_msg = "susbend"
                }
            }

            doIt = confirm('Are you Sure want to ' + status_msg + ' this?');
            if (doIt) {
                $.ajax({//Make the Ajax Request
                    type: "POST",
                    url: "./ajx-status.php",
                    data: {status: statuss, id: idd},
                    success: function (data) {
                        if (data == "success") {
                            if (statuss == "delete") {
                                $('#row_' + idd).fadeOut('slow');
                            }
                            else {
                                if (statuss == "susbend") {
                                    $('#href_status_' + idd).html('release');
                                    $('#status_' + idd).removeAttr('style');
                                }
                                else {
                                    $('#href_status_' + idd).html('susbend');
                                    $('#status_' + idd).css('background-color', '#C16161');
                                }

                            }
                        }
                    }
                });
            }
        }

    </script>


	<?php

	$per_page = 10;  //Display Images or Content
	$count    = mysql_query( "select count(*) from quiz" );
	while ( $row2 = mysql_fetch_row( $count ) ) {
		$total = $row2[0];
	}
	$pages = ceil( $total / $per_page );

	?>
    <h1>Список вопросов</h1>
    <div class="search-background" style='margin-left:250px;'>
        <label><img src="./images/load.gif" alt=""/></label>
    </div>
    <div id="content">
        &nbsp;
    </div>
    <div id="paging_button" style="margin: 0 auto;" align='center'>

        <ul>
			<?php
			//echo '<li id=1>First</li>';
			for ( $i = 1; $i <= $pages; $i ++ ) {
				$jk = $i - 1;
				echo '<li id="' . $jk . '">' . $i . '</li>';
			}
			//echo '<li id="'.$pages.'">Last</li>';
			?>
        </ul>
    </div>
	<?php
}
?>