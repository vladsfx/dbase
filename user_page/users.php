<?php

session_start();
if ((empty($_SESSION['user_data']['user_id'])) ||
    ($_SESSION['user_data']['user_stat'] != 'admin')) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/database_connect.php';
    include_once '../scripts/main_scripts.php';
    include_once '../scripts/delete_user.php';

    include_once '../content/head.php';
    include_once '../content/header.php';
    nav_user();

    ?>
<div class="once_user">
	<div id="list_users">
		<h2></h2>
			<form action="" method="POST" id="act">
				<table>
					<thead style="background: #d9d9d9">
						<tr>
							<th>Выбрать</th>
							<th>Фамилия</th>
							<th>Имя</th>
							<th>Логин</th>
							<th>Телефон</th>
							<th>Статус</th>
							<th>Активность</th>
							<th>Время входа</th>
						</tr>
					</thead>
					<tbody>
<?php
$sql_user = mysqli_query($connect, "SELECT * FROM `users`");
    while ($row = mysqli_fetch_assoc($sql_user)) {
        ?>
						<tr>
							<td><input type="checkbox" name="user_id" value="<?=$row['user_id']?>"></td>
							<td><?=$row['fname']?></td>
							<td><?=$row['name']?></td>
							<td><?=$row['user_login']?></td>
							<td>+7<?=$row['telephon']?></td>
							<td><?=$row['user_stat']?></td>
							<td><?=$row['online']?></td>
							<td><?=date('d.m.Y H:i', strtotime($row['last_visit']))?></td>
						</tr>
<?php }?>
					</tbody>
				</table>
					<div id="del_users">
						<input type="submit" name="update_users" value="Редактировать">
						<input type="submit" name="del_users" value="Удалить" style="background: red">
					</div>
			</form>
	</div>
</div>
<script>

setTimeout("window.location.reload()", 10000);

</script>

<?php

    include_once '../content/footer.php';
}

?>
