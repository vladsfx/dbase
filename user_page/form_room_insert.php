<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/database_scripts.php';
    include_once '../scripts/main_scripts.php';
    include_once '../scripts/add.php';

    include_once '../content/head.php';
    include_once '../content/header.php';
    nav_user();

    ?>

<div class="add">
	<div id="object_add">
		<h2>Новая квартира</h2>
		<form action="<?php addRoom($connect);?>" enctype="multipart/form-data" method="POST" id="act">
		<table>
			<tr>
				<td><b>Насел. пункт:</b></td>
				<td><select name="locality_id">
					<option value="">Выберите из списка</option>
					<?php listLocality($connect);?>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Район:</b></td>
				<td>
					<select name="district_id">
					<option value="">Выберите из списка</option>
					<?php listDistricts($connect);?>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Адрес:</b></td><td><textarea name="adress_room" id="adress" placeholder="Введите адрес" required></textarea></td>
			</tr>
			<tr>
				<td><b>Этаж:</b></td><td><input type="number" name="level_room" placeholder="Введите этаж квартиры" required></td>
			</tr>
			<tr>
				<td><b>Кол-во комнат:</b></td><td><input type="number" name="num_room" placeholder="Введите количество комнат" required></td>
			</tr>
			<tr>
				<td><b>Площадь:</b></td><td><input type="number" name="sq_room" placeholder="Введите площадь квартиры" required></td><td><b>кв.м</b></td>
			</tr>
			<tr>
				<td><b>Собственник:</b></td><td><select name="client_id">
					<option value="">Выберите из списка</option>
					<?php listClients($connect);?>
				</select></td>
			</tr>
			<tr>
				<td><b>Цена:</b></td><td><input type="number" name="price_room" placeholder="Введите цену" required></td><td><b>руб</b></td>
			</tr>
			</table>
				<p><b>Доп. информация:</b></p>
				<textarea name="room_info" id="object_info" cols="120" rows="5" placeholder="Дополнительная информация о квартире" required></textarea>
			<div class="img_ent">
				<p><b>Добавить фото:</b></p>
				<p><input type="file" name="room_img[]" multiple="" accept="image/*,image/jpeg"></p>
			</div>
				<input type="submit" name="entry_rooms" value="Добавить данные">
		</form>

	</div>
</div>
<?php

    include_once '../content/footer.php';
}

?>