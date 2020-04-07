<?php

if (isset($_REQUEST['del_users'])) {
    if (isset($_REQUEST['user_id']) and $_REQUEST['user_id'] != $_SESSION['user_data']['user_id']) {
        $sql_user = mysqli_query($connect, "DELETE FROM `users` WHERE `user_id`='{$_REQUEST['user_id']}'");
    }
    mysqli_close($connect);
}
