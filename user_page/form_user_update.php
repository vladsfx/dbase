<?php

session_start();

if ((empty($_SESSION['user_data']['user_id'])) ||
    ($_SESSION['user_data']['user_stat'] != 'admin')) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/database_scripts.php';
    include_once '../scripts/main_scripts.php';
    include_once '../scripts/update.php';

    include_once '../content/head.php';
    include_once '../content/header.php';
    nav_user();

    ?>

<div class="add">
		<h2>Изменить данные сотрудника</h2>
<div id="clients_add">
		<form action="<?=updateUser($connect)?>" method="POST">
<?php
$us_query = "SELECT * FROM `users`
				WHERE `user_id` = '" . $_REQUEST['user_id'] . "'";

    $us_arr = mysqli_query($connect, $us_query);
    $row    = mysqli_fetch_assoc($us_arr);
    ?>
			<table id="add_cl">
				<tr>
					<td><b>Ф.И.О.:</b></td>
					<td>
						<input type="text" name="fname" value="<?=$row['fname']?>">
						<input type="text" name="name" value="<?=$row['name']?>">
					</td>
				</tr>
				<tr>
					<td><b>Телефон:</b></td><td><input type="text" name="user_telephone" value="<?=$row['telephon']?>"></td>
				</tr>
				<tr>
					<td><b>Логин:</b></td><td><input type="text" name="user_login" value="<?=$row['user_login']?>"></td>
				</tr>
				<tr>
					<td><b>Пароль:</b></td><td><input type="password" name="user_pass" value="<?=$row['user_pass']?>"></td>
				</tr>
			</table>
		<input type="submit" name="update_user" value="Редактировать данные">
	</form>
	</div>
</div>

<?php

    include_once '../content/footer.php';
}

?>