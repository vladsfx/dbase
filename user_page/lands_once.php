<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/main_scripts.php';
    include_once '../scripts/foll_link.php';
    include_once '../scripts/delete_land.php';

    include_once '../content/head.php';
    include_once '../content/header.php';
    nav_user();

    ?>

<div class="once">
	<div id="char">
			<h2>Земельный участок</h2>
			<?php linkLand($connect);?>
		</div>

<div id="land">
	<form action="" method="POST">
	<input type="submit" name="entry_land" value="Новая запись">
	<button type="submit" name="update_land" formaction="form_land_update?land_id=<?=$_REQUEST['land_id']?>" id="">Редактировать запись</button>
	<input type="submit" name="del_land" value="Удалить запись">
	</form>
</div>
</div>

<?php

    include_once '../content/footer.php';
}

?>