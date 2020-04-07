<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/main_scripts.php';
    include_once '../scripts/foll_link.php';
    include_once '../scripts/delete_room.php';

    include_once '../content/head.php';
    include_once '../content/header.php';
    nav_user();

    ?>

<div class="once">
		<div id="char">
			<h2>Квартира</h2>
			<?php linkRoom($connect);?>
		</div>

<div id="act">
	<form action="" method="POST">
	<input type="submit" name="entry_room" value="Новая запись">
	<button type="submit" name="update_room" formaction="form_room_update?room_id=<?=$_REQUEST['room_id']?>" id="update_room">Редактировать запись</button>
	<input type="submit" name="del_room" value="Удалить запись">
	</form>
</div>
</div>

<?php

    include_once '../content/footer.php';
}

?>
