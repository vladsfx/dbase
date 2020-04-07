<?php

// Удаление дома
if (isset($_REQUEST['del_house']) and $_SESSION['user_data']['user_stat'] == 'admin') {
    if (isset($_REQUEST['house_id'])) {
        $sql_house_img = mysqli_query($connect, "DELETE FROM `house_images` WHERE `house_id`='{$_REQUEST['house_id']}'");
        $sql_house     = mysqli_query($connect, "DELETE FROM `houses` WHERE `house_id`='{$_REQUEST['house_id']}'");
    }
    mysqli_close($connect);
}
