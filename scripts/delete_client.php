<?php

// Удаление дома
if (isset($_REQUEST['del_client']) and $_SESSION['user_data']['user_stat'] == 'admin') {
    if (isset($_REQUEST['client_id'])) {
        $sql_client = mysqli_query($connect, "DELETE FROM `clients` WHERE `client_id`='{$_REQUEST['client_id']}'");
    }
    mysqli_close($connect);
}
