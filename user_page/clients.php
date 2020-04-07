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
					<h2>Клиенты</h2>
<?php

    $query_count        = "SELECT `client_id` FROM `clients`";
    $count_client_query = mysqli_query($connect, $query_count) or die(mysqli_error($connect));
    $count_client       = mysqli_num_rows($count_client_query);

    $query_count_user        = "SELECT `client_id` FROM `clients` WHERE `user_id`='" . $_SESSION['user_data']['user_id'] . "'";
    $count_client_query_user = mysqli_query($connect, $query_count_user) or die(mysqli_error($connect));
    $count_client_user       = mysqli_num_rows($count_client_query_user);
    ?>
					<ul>
						<li><b>Всего:&nbsp;<?=$count_client?></b></li>
						<li><b>Мои:&nbsp;<?=$count_client_user?></b></li>
					</ul>
					<?php
if ($_SESSION['user_data']['user_stat'] == 'admin') {
        ?>
					<div id="adm">
						<form action="" method="POST">
							<select name="user_id">
								<option value="">Сотрудники</option>
								<?php listUser($connect);?>
							</select>
							<input type="submit" name="search_admin" value="Показать">
						</form>
					</div>
	<?php }?>
				</div>
				<div id="clients_title">
					<table>
						<tr>
							<td><b>Фамилия</b></td>
							<td><b>Имя</b></td>
							<td><b>Отчество</b></td>
							<td><b>Дата регистрации</b></td>
							<td><b>Телефон</b></td>
						</tr>
					</table>
				</div>

				<form action="" id="obj_list_client" method="">
				<?php searchClient($connect);?>
				</form>
	</div>
</div>
	<div class="conteiner2">
		<h2>Поиск</h2>
		<form action="" method="POST">
			<fieldset>
				<legend>Данные клиента</legend>
				<p>Фамилия:</p>
				<input type="text" name="fname">
				<p>Имя:</p>
				<input type="text" name="name1">
				<p>Отчество:</p>
				<input type="text" name="name2">
			</fieldset>
			<button type="submit" name="search_cl">Найти</button>
			<button type="submit" name="entry_client">Новая запись</button>
			</form>
		<div id="back">
			<a href="#top"><button type="submit" name="top">Вверх</button></a>
		</div>
	</div>

<?php

    include_once '../content/footer.php';
}

?>
