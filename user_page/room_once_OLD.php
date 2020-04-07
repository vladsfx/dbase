<?php

session_start();

if (empty($_SESSION['user_data']['user_id'])) {
    exit('<h1>Error 404</h1><p>Страница не найдена!</p>');
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
<script>
$(function() {
var sldr = $('.sldr'),
sldrContent = sldr.html(),
slideWidth = $('.sl_ctr').outerWidth(),
slideCount = $('.sldr img').length,
prv_b = $('.prv_b'),
nxt_b = $('.nxt_b'),
// sldrInterval = 500,
animateTime = 1500,
course = 1,
margin = - slideWidth;
$('.sldr img:last').clone().prependTo('.sldr');$('.sldr img').eq(1).clone().appendTo('.sldr');$('.sldr').css('margin-left',-slideWidth);function nxt_bSlide(){interval=window.setInterval(animate,sldrInterval)}function animate(){if(margin==slideCount*slideWidth-slideWidth){sldr.css({'marginLeft':-slideWidth});margin=-slideWidth*2}else if(margin==0&&course==-1){sldr.css({'marginLeft':slideWidth*slideCount});margin=-slideWidth*slideCount+slideWidth}else{margin=margin-slideWidth*(course)}sldr.animate({'marginLeft':margin},animateTime)}function sldrStop(){window.clearInterval(interval)}prv_b.click(function(){if(sldr.is(':animated')){return false}var course2=course;course=-1;animate();course=course2});nxt_b.click(function(){if(sldr.is(':animated')){return false}var course2=course;course=1;animate();course=course2});sldr.add(nxt_b).add(prv_b).hover(function(){sldrStop()},nxt_bSlide);nxt_bSlide()});
</script>
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
