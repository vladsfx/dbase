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
		<h2>Редактировать данные по дому</h2>
		<form action="<?=updateHouse($connect)?>" enctype="multipart/form-data" method="POST" id="act">
<?php
$house_query = "SELECT * FROM `houses`
LEFT JOIN
`users` ON
houses.user_id = users.user_id
LEFT JOIN
`clients` ON
houses.client_id = clients.client_id
LEFT JOIN
`districts` ON
houses.district_id = districts.district_id
LEFT JOIN
`locality` ON
houses.locality_id = locality.locality_id
WHERE house_id = '" . $_REQUEST['house_id'] . "'";

    $house_arr = mysqli_query($connect, $house_query);
    $row       = mysqli_fetch_assoc($house_arr);
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
				<td><b>Адрес:</b></td><td><textarea name="house_adress" id="adress"><?=$row['house_adress']?></textarea></td>
			</tr>
			<tr>
				<td><b>Площадь дома:</b></td><td><input type="number" name="house_area" value="<?=$row['house_area']?>"></td>
			</tr>
			<tr>
				<td><b>Площадь участка:</b></td><td><input type="number" name="house_land" value="<?=$row['house_land']?>"></td>
			</tr>

			<tr>
				<td><b>Собственник:</b></td><td><select name="client_id">
					<option value="<?=$row['client_id']?>"><?=$row['fname_cl'] . '&nbsp;' . $row['name1'] . '&nbsp;' . $row['name2']?></option>
					<?php listClients($connect);?>
				</select></td>
			</tr>
			<tr>
				<td><b>Цена:</b></td><td><input type="number" name="price_house" value="<?=$row['house_price']?>"></td><td><b>руб</b></td>
			</tr>
			<tr>
				<td><b>Статус:</b></td><td>
					<input type="radio" name="status_house" value="Зарегистрирован" checked>
					<input type="radio" name="status_house" value="Отложен">
					<input type="radio" name="status_house" value="Продан"></td>
				<td><div style="font-weight: bold; color: green;">Зарегистрирован</div>
						<div style="font-weight: bold; color: blue;">Отложен</div>
						<div style="font-weight: bold; color: red;">Продан</div></td>
			</tr>
			</table>
				<p><b>Доп. информация:</b></p>
				<textarea name="house_info" id="object_info" cols="120" rows="5"><?=$row['house_descript']?></textarea>
			<div class="img_ent">
				<p><b>Добавить фото:</b></p>
				<p><input type="file" name="house_img[]" multiple="" accept="image/*,image/jpeg"></p>
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
				<input type="submit" name="update_houses" value="Редактировать данные">
		</form>

	</div>
</div>
<?php

    include_once '../content/footer.php';
}

?>

