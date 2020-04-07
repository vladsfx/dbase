<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
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
		<h2>Изменить данные клиента</h2>
<div id="clients_add">
		<form action="<?=updateClient($connect)?>" method="POST">
<?php
$cl_query = "SELECT * FROM `clients`
				LEFT JOIN `users` ON
				clients.user_id = users.user_id
				WHERE `client_id` = '" . $_REQUEST['client_id'] . "'";

    $cl_arr = mysqli_query($connect, $cl_query);
    $row    = mysqli_fetch_assoc($cl_arr);
    ?>
			<table id="add_cl">
				<tr>
					<td><b>Ф.И.О.:</b></td>
					<td>
						<input type="text" name="fname" value="<?=$row['fname_cl']?>">
						<input type="text" name="name1" value="<?=$row['name1']?>">
						<input type="text" name="name2" value="<?=$row['name2']?>">
					</td>
				</tr>
				<tr>
					<td><b>Номер паспорта:</b></td><td><input type="text" name="pass_num" value="<?=$row['pass_num']?>"></td>
				</tr>
				<tr>
					<td><b>Код паспорта:</b></td><td><input type="text" name="pass_code" value="<?=$row['pass_code']?>"></td>
				</tr>
				<tr>
					<td><b>Дата выдачи паспорта:</b></td><td><input type="text" name="pass_date" value="<?=$row['pass_date']?>"></td>
				</tr>
				<tr>
					<td><b>Кем выдан:</b></td><td><textarea name="pass_iss" id="pass" required><?=$row['pass_iss']?></textarea></td>
				</tr>
				<tr>
					<td><b>Адрес регистрации:</b></td><td><textarea name="adress_reg" id="pass"><?=$row['adress_reg']?></textarea></td>
				</tr>
				<tr>
					<td><b>Телефон:</b></td><td><input type="text" name="client_telephone" value="<?=$row['client_telephone']?>"></td>
				</tr>
				<tr>
					<td><b>Email:</b></td><td><input type="text" name="client_email" value="<?=$row['email']?>"></td>
				</tr>
				<tr>
					<td><b>Дополнительная информация:</b></td><td></td>
				</tr>
			</table>
				<textarea name="client_info" id="client_info" cols="120" rows="5"><?=$row['client_info']?></textarea>
				<?php
if ($_SESSION['user_data']['user_stat'] == 'admin') {
        ?>
					<div id="adm_update">
						<p style="color: red; font-weight: bold">Куратор:</p>
						<select name="user_id">
							<option value="<?=$row['user_id']?>"><?=$row['fname'] . '&nbsp;' . $row['name']?></option>
							<?php listUser($connect);?>
						</select>
					</div>
	<?php }?>
		<input type="submit" name="update_clients" value="Редактировать данные">
	</form>
	</div>
</div>

<?php

    include_once '../content/footer.php';
}

?>
