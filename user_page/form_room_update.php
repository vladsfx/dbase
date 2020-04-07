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
	<div id="object_add">
		<h2>Редактировать данные квартиры</h2>
		<form action="<?=updateRoom($connect)?>" enctype="multipart/form-data" method="POST" id="act">
<?php
$room_query = "SELECT * FROM `rooms`
LEFT JOIN
`users` ON
rooms.user_id = users.user_id
LEFT JOIN
`clients` ON
rooms.client_id = clients.client_id
LEFT JOIN
`districts` ON
rooms.district_id = districts.district_id
LEFT JOIN
`locality` ON
rooms.locality_id = locality.locality_id
WHERE `room_id` = '" . $_REQUEST['room_id'] . "'";

    $row = mysqli_fetch_assoc(mysqli_query($connect, $room_query));
    ?>
		<table>
			<tr>
				<td><b>Насел. пункт:</b></td>
				<td><select name="locality_id">
					<option value="<?=$row['locality_id']?>"><?=$row['local']?></option>
					<?php listLocality($connect);?>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Район:</b></td>
				<td>
					<select name="district_id">
					<option value="<?=$row['district_id']?>"><?=$row['distr']?></option>
					<?php listDistricts($connect);?>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Адрес:</b></td><td><textarea name="adress_room" id="adress"><?=$row['room_adress']?></textarea></td>
			</tr>
			<tr>
				<td><b>Этаж:</b></td><td><input type="number" name="level_room" value="<?=$row['room_level']?>"></td>
			</tr>
			<tr>
				<td><b>Кол-во комнат:</b></td><td><input type="number" name="num_room" value="<?=$row['room_num']?>"></td>
			</tr>
			<tr>
				<td><b>Площадь:</b></td><td><input type="number" name="sq_room" value="<?=$row['room_square']?>"></td><td><b>кв.м</b></td>
			</tr>
			<tr>
				<td><b>Собственник:</b></td><td><select name="client_id">
					<option value="<?=$row['client_id']?>"><?=$row['fname_cl'] . '&nbsp;' . $row['name1'] . '&nbsp;' . $row['name2']?></option>
					<?php listClients($connect);?>
				</select></td>
			</tr>
			<tr>
				<td><b>Цена:</b></td><td><input type="number" name="price_room" value="<?=$row['room_price']?>"></td><td><b>руб</b></td>
			</tr>
			<tr>
				<td><b>Статус:</b></td>
					<td><input type="radio" name="status_room" value="Зарегистрирован" checked>
					<input type="radio" name="status_room" value="Отложен">
					<input type="radio" name="status_room" value="Продан"></td>
					<td><div style="font-weight: bold; color: green;">Зарегистрирован</div>
						<div style="font-weight: bold; color: blue;">Отложен</div>
						<div style="font-weight: bold; color: red;">Продан</div></td>
			</tr>
			</table>
				<p><b>Доп. информация:</b></p>
				<textarea name="room_info" id="object_info" cols="120" rows="5"><?=$row['room_descript']?></textarea>
			<div class="img_ent">
				<p><b>Добавить фото:</b></p>
				<p><input type="file" name="room_img[]" multiple="" accept="image/*,image/jpeg"></p>
			</div>
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
				<input type="submit" name="update_rooms" value="Редактировать данные">
		</form>
	</div>
</div>

<?php

    include_once '../content/footer.php';
}

?>