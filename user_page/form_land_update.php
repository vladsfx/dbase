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
		<h2>Редактировать данные по участку</h2>
		<form action="<?=updateLand($connect)?>" enctype="multipart/form-data" method="POST" id="act">
<?php
$land_query = "SELECT * FROM `lands`
LEFT JOIN
`users` ON
lands.user_id = users.user_id
LEFT JOIN
`clients` ON
lands.client_id = clients.client_id
LEFT JOIN
`districts` ON
lands.district_id = districts.district_id
LEFT JOIN
`locality` ON
lands.locality_id = locality.locality_id
WHERE land_id = '" . $_REQUEST['land_id'] . "'";

    $land_arr = mysqli_query($connect, $land_query);
    $row      = mysqli_fetch_assoc($land_arr);
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
				<td><b>Адрес:</b></td><td><textarea name="land_adress" id="adress"><?=$row['land_adress']?></textarea></td>
			</tr>
			<tr>
				<td><b>Площадь участка:</b></td><td><input type="text" name="land_area" value="<?=$row['land_area']?>"></td><td><b>сот.</b></td>
			</tr>
			<tr>
				<td><b>Собственник:</b></td><td><select name="client_id">
					<option value="<?=$row['client_id']?>"><?=$row['fname_cl'] . '&nbsp;' . $row['name1'] . '&nbsp;' . $row['name2']?></option>
					<?php listClients($connect);?>
				</select></td>
			</tr>
			<tr>
				<td><b>Цена:</b></td><td><input type="number" name="price_land" value="<?=$row['land_price']?>"></td><td><b>руб</b></td>
			</tr>
			<tr>
				<td><b>Статус:</b></td><td>
					<input type="radio" name="status_land" value="Зарегистрирован" checked>
					<input type="radio" name="status_land" value="Отложен">
					<input type="radio" name="status_land" value="Продан"></td>
					<td><div style="font-weight: bold; color: green;">Зарегистрирован</div>
						<div style="font-weight: bold; color: blue;">Отложен</div>
						<div style="font-weight: bold; color: red;">Продан</div></td>
			</tr>
			</table>
			<div id="land_info">
				<p><b>Доп. информация:</b></p>
				<textarea name="land_info" id="object_info" cols="120" rows="5"><?=$row['land_descript']?></textarea>
			</div>
			<div class="img_ent">
				<p><b>Добавить фото:</b></p>
				<p><input type="file" name="land_img[]" multiple="" accept="image/*,image/jpeg"></p>
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
				<div id="update_lands">
				<input type="submit" name="update_lands" value="Редактировать данные">
				</div>
		</form>

	</div>
</div>
<?php

    include_once '../content/footer.php';
}

?>
