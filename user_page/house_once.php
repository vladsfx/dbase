<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/main_scripts.php';
    include_once '../scripts/foll_link.php';
    include_once '../scripts/delete_house.php';

    include_once '../content/head.php';
    include_once '../content/header.php';

    nav_user();

    ?>

<div class="once">
		<div id="char">
			<h2>Дом</h2>
			<?php linkHouse($connect);?>
		</div>

	<div id="house_once">
		<form action="" method="POST">
		<input type="submit" name="entry_house" value="Новая запись">
		<button type="submit" name="update_house" formaction="form_house_update?house_id=<?=$_REQUEST['house_id']?>">Редактировать запись</button>
		<input type="submit" name="del_house" value="Удалить запись">
		</form>
	</div>
</div>


<?php

    include_once '../content/footer.php';
}

?>