
<?php
$file = "auth/config.php"; 
if(!is_readable($file) or !is_writeable($file))
{
    echo " <span class=\"errortext\">Не правильные разрешения для файла config.php! <br>
		</span>";
}
?>


<h4>Введите данные для входа в панель тестов</h4>
<div class="form">
 <form name=setf method=POST action='<?php echo $PHP_SELF;?>'>

	<div class='form_con'> <div class='form_element lable'>Имя и Фамилия пользователя </div><div class='form_element'><input class='textbox' name="usern"  type=text value='<?php echo "$un";?>' ></div></div>
	<div class='form_con'> <div class='form_element lable'>Пароль </div><div class='form_element'><input class='textbox' name="passw"  type=password value='<?php echo "$pw";?>' ></div></div>
	<input name="type" type=hidden value="auth">
	<input type=submit value="Войти" class='form_button' style='float:left;'>
	
 </form>
