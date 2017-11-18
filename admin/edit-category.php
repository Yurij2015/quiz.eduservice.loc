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
            $('#m4').html("<span class='curr_mnu'>Редактировать категорию</span>");

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

                $("#content").load("ajx-edit-category.php?page=" + this.id, hideLoader);

                return false;
            });

            $("#1").css({'background-color': '#006699'});
            showLoader();
            $("#content").load("ajx-edit-category.php?page=0", hideLoader);

        });

        function changestatus(statuss, idd) {
            if (statuss == "edit") {
                $('#catname_' + idd).removeAttr('readonly');
                $('#catstatus_' + idd).removeAttr('disabled');
            }
            else {
                $catname = $('#catname_' + idd).val();
                $catstatus = $('#catstatus_' + idd).val();
                doIt = confirm('Are you Sure want to ' + statuss + ' this?');
                if (doIt) {
                    $.ajax({//Make the Ajax Request
                        type: "POST",
                        url: "./ajx-category-status.php",
                        data: {catname: $catname, catstatus: $catstatus, status: statuss, id: idd},
                        success: function (data) {
                            alert(data)
                            window.location.reload();

                        }
                    });
                }
            }
        }

    </script>


	<?php

	$per_page = 10;  //Display Images or Content
	$count    = mysql_query( "select count(*) from category" );
	while ( $row2 = mysql_fetch_row( $count ) ) {
		$total = $row2[0];
	}
	$pages = ceil( $total / $per_page );

	?>
    <h1>Редактор категорий</h1>
    <div class="search-background" style='margin-left:250px;'>
        <label><img src="./images/load.gif" alt=""/></label>
    </div>
    <div id="content">
        &nbsp;
    </div>
	<?php
	if ( $pages > 1 ) {
		?>

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
}
?>
  