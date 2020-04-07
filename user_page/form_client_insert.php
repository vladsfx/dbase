<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/main_scripts.php';
    include_once '../scripts/add.php';

    include_once '../content/head.php';
    include_once '../content/header.php';
    nav_user();

    ?>

<div class="add">
		<h2>Новый клиент</h2>
<div id="clients_add">
		<form action="<?php addClient($connect);?>" method="POST">
			<table id="add_cl">
				<tr>
					<td><b>Ф.И.О.:</b></td>
					<td>
						<input type="text" name="fname" placeholder="Иванов" pattern="^[А-ЯЁ][а-яё\s]+$" required>
						<input type="text" name="name1" placeholder="Иван" pattern="^[А-ЯЁ][а-яё\s]+$" required>
						<input type="text" name="name2" placeholder="Иванович" pattern="^[А-ЯЁ][а-яё\s]+$">
					</td>
				</tr>
				<tr>
					<td><b>Номер паспорта:</b></td><td><input type="text" name="pass_num" placeholder="0000 000000" pattern="\[0-9]{4}\ \[0-9]{6}\" required></td>
				</tr>
				<tr>
					<td><b>Код паспорта:</b></td><td><input type="text" name="pass_code" placeholder="000-000" pattern="\[0-9]{3}\-\[0-9]{3}\" required></td>
				</tr>
				<tr>
					<td><b>Дата выдачи паспорта:</b></td><td><input type="text" name="pass_date" placeholder="дд.мм.гггг" pattern="[0-9]{2}\.[0-9]{2}\.[0-9]{4}" required></td>
				</tr>
				<tr>
					<td><b>Кем выдан:</b></td><td><textarea name="pass_iss" id="pass" placeholder="Кем выдан" required></textarea></td>
				</tr>
				<tr>
					<td><b>Адрес регистрации:</b></td><td><textarea name="adress_reg" id="pass"  placeholder="Адрес регистрации" required></textarea></td>
				</tr>
				<tr>
					<td><b>Телефон:</b></td><td><input type="text" name="client_telephone" pattern="[0-9]{10}" placeholder="десять цифр 9000000000" required></td>
				</tr>
				<tr>
					<td><b>Email:</b></td><td><input type="text" name="client_email" pattern="[\x1F-\xBF]*" placeholder="example@email.com"></td>
				</tr>
				<tr>
					<td><b>Дополнительная информация:</b></td><td></td>
				</tr>
			</table>
				<textarea name="client_info" id="client_info" cols="120" rows="5" placeholder="Дополнительная информация о клиенте"></textarea>
		<input type="submit" name="entry_clients" value="Добавить">
	</form>
	</div>
</div>

<?php

    include_once '../content/footer.php';
}

?>
