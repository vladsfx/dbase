<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/database_connect.php';
    include_once '../scripts/database_scripts.php';
    include_once '../scripts/main_scripts.php';

    include_once '../scripts/search.php';

    include_once '../content/head.php';
    include_once '../content/header.php';
    nav_user();

    ?>

<div class="conteiner1">
	<div id="object">
				<div id="center">
					<h2>Дома</h2>
<?php

    $query_count       = "SELECT house_id FROM houses";
    $count_house_query = mysqli_query($connect, $query_count) or die(mysqli_error($connect));
    $count_house       = mysqli_num_rows($count_house_query);

    $query_count_user       = "SELECT house_id FROM houses WHERE user_id='" . $_SESSION['user_data']['user_id'] . "'";
    $count_house_query_user = mysqli_query($connect, $query_count_user) or die(mysqli_error($connect));
    $count_house_user       = mysqli_num_rows($count_house_query_user);
    ?>
					<ul>
						<li><b>Всего:&nbsp;<?=$count_house?></b></li>
						<li><b>Мои:&nbsp;<?=$count_house_user?></b></li>
					</ul>
					<?php
if ($_SESSION['user_data']['user_stat'] == 'admin') {
        ?>
					<div id="adm">
						<form action="" method="POST">
							<select name="user_id">
								<option value="">Объекты сотрудников</option>
								<?php listUser($connect);?>
							</select>
							<input type="submit" name="search_admin" value="Показать">
						</form>
					</div>
					<?php
} else {
        ?>
					 <div id="us">
						<form action="" method="POST">
							<input type="submit" name="search_user" value="Показать">
						</form>
					</div>
<?php }?>
				</div>
			<div id="obj_list">
				<?php searhHouse($connect);?>
			</div>
	</div>
	</div>
	<div class="conteiner2">
		<h2>Поиск</h2>
		<form action="" method="POST">
			<fieldset>
				<legend>По населенным пунктам и районам</legend>
				<p>Населенный пункт:</p>
				<select name="local">
					<option value="">Выберите из списка</option>
					<?php listLocality($connect);?>
				</select>
				<p>Район города:</p>
				<select name="distr">
					<option value="">Выберите из списка</option>
					<?php listDistricts($connect);?>
				</select>
			</fieldset>
			<fieldset>
				<legend>По характеристикам</legend>
				<p>Площадь дома:</p>
				<input type="number" name="house_area">
				<p>Площадь участка:</p>
				<input type="number" name="house_land">
			</fieldset>
			<fieldset>
				<legend>Цена</legend>
				<p>От:</p>
				<input type="number" name="bottom">
				<p>До:</p>
				<input type="number" name="top">
			</fieldset>
			<button type="submit" name="house_search">Найти</button>
			</form>
		<div id="back">
			<a href="#top"><button type="submit" name="top">Вверх</button></a>
		</div>
	</div>

<?php

    include_once '../content/footer.php';
}

?>