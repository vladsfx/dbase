<header>
	<div class="Namebase">
		<div class="logo-2">
			<img  src="/img/logo-2.png" alt="«Доступное жильё»" title='Агентство недвижимости "Доступное жилье"'  id="top">
		</div>
<?php
if (isset($_SESSION['user_data']['user_id'])) {
    ?>
		<form action="" method="POST">
		<button type="submit">Выйти</button>
		<input type="hidden" name="link" value="exit">
		</form>
<div id="text_name">
		<p>
		<?php
if (isset($_SESSION['user_data']['user_name'])) {
        echo "Здравствуйте,<br />" . $_SESSION['user_data']['user_name'];
    }
    ?>
		</p>
		</div>
<?php }?>
		<h1>Агентство недвижимости «Доступное жильё»</h1>

	</div>
</header>
