<?php

// Удаление квартиры
if (isset($_REQUEST['del_room']) and $_SESSION['user_data']['user_stat'] == 'admin') {
    if (isset($_REQUEST['room_id'])) {
        $sql_room_img = mysqli_query($connect, "DELETE FROM `room_images` WHERE `room_id`='{$_REQUEST['room_id']}'");
        $sql_room     = mysqli_query($connect, "DELETE FROM `rooms` WHERE `room_id`='{$_REQUEST['room_id']}'");
    }
    mysqli_close($connect);
}
