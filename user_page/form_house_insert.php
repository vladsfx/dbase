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
		<h2>Новый дом</h2>
		<form action="<?php addHouse($connect);?>" enctype="multipart/form-data" method="POST" id="act">
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
				<td><b>Адрес:</b></td><td><textarea name="house_adress" id="adress" placeholder="Введите адрес" required></textarea></td>
			</tr>
			<tr>
				<td><b>Площадь дома:</b></td><td><input type="number" name="house_area" placeholder="Введите площадь дома" required></td><td><b>кв.м.</b></td>
			</tr>
			<tr>
				<td><b>Площадь участка:</b></td><td><input type="number" name="house_land" placeholder="Введите площадь участка" required></td><td><b>сот.</b></td>
			</tr>

			<tr>
				<td><b>Собственник:</b></td><td><select name="client_id">
					<option value="">Выберите из списка</option>
					<?php listClients($connect);?>
				</select></td>
			</tr>
			<tr>
				<td><b>Цена:</b></td><td><input type="number" name="price_house" placeholder="Введите цену" required></td><td><b>руб</b></td>
			</tr>
			</table>
				<p><b>Доп. информация:</b></p>
				<textarea name="house_info" id="object_info" cols="120" rows="5" placeholder="Дополнительная информация о доме" required></textarea>
			<div class="img_ent">
				<p><b>Добавить фото:</b></p>
				<p><input type="file" name="house_img[]" multiple="" accept="image/*,image/jpeg"></p>
			</div>
				<input type="submit" name="entry_houses" value="Добавить данные">
		</form>

	</div>
</div>
<?php

    include_once '../content/footer.php';
}

?>
