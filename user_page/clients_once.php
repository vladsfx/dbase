<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
    exit(include_once '../content/not_found.php');
} else {

    include_once '../scripts/main_scripts.php';
    include_once '../scripts/foll_link.php';
// include_once '../scripts/delete_client.php';

    include_once '../content/head.php';
    include_once '../content/header.php';

    nav_user();

    ?>

<div class="once">
	<div id="char_clients">
		<h2>Клиент</h2>
		<?php linkClient($connect);?>
	</div>
		<form action="" method="POST" id="client">

		<button type="submit" name="update_client" formaction="form_client_update?client_id=<?=$_REQUEST['client_id']?>" id="">Редактировать запись</button>
		<!-- <input type="submit" name="del_client" value="Удалить запись"> -->
		</form>
</div>

<?php

    include_once '../content/footer.php';
}

?>
