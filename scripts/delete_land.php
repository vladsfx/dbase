<?php

// Удаление дома
if (isset($_REQUEST['del_land']) and $_SESSION['user_data']['user_stat'] == 'admin') {
    if (isset($_REQUEST['land_id'])) {
        $sql_land_img = mysqli_query($connect, "DELETE FROM `land_images` WHERE `land_id`='{$_REQUEST['land_id']}'");
        $sql_land     = mysqli_query($connect, "DELETE FROM `lands` WHERE `land_id`='{$_REQUEST['land_id']}'");
    }
    mysqli_close($connect);
}
