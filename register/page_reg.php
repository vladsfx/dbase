<?php

include_once '../scripts/main_scripts.php';
include_once '../scripts/database_scripts.php';

include_once '../content/head.php';
include_once '../content/header.php';

?>

<div id="entr">
	<form  action="<?php user_reg($connect);?>" method="POST">
		<label>Фамилия:*<input type="text" name="new_fname" placeholder="Иванов" pattern="^[А-ЯЁ][а-яё\s]+$"></label>
		<label>Имя:*<input type="text" name="new_name" placeholder="Иван" pattern="^[А-ЯЁ][а-яё\s]+$"></label>
		<label>Телефон:*<input type="tel" name="new_telephone" placeholder="десять цифр 9000000000" pattern="[0-9]{10}"></label>
		<label>Логин для входа:*<input type="text" name="new_login" placeholder="не меньше 3 символов" pattern="[\x1F-\xBF]{3,}"></label>
		<label>Пароль для входа:*<input type="password" name="new_pass" placeholder="не меньше 5 символов" pattern="[\x1F-\xBF]{5,}"></label>
		<label for=""><input type="checkbox" name="reg_admin" value="admin">&nbsp;<ins>admin</ins></label>
		<label class="pass_adm">Логин администратора:*<input type="text" name="log_admin" placeholder="Логин администратора"></label>
		<label class="pass_adm">Пароль администратора:*<input type="password" name="pass_admin" placeholder="Пароль администратора"></label>
		<p><i>* - Поля, обязательные для заполнения</i></p>
		<button id="entr_but" type="submit" name="new_user" value="reg">Регистрация</button>
		<button id="entr_but" type="submit" name="cancel" value="canc" style="background-color: red;">Отмена</button>
	</form>
</div>

<?php

include_once '../content/footer.php';

?>
