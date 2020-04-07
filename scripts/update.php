<?php

include_once 'database_connect.php';

function updateRoom($connect)
{
    $locality_id   = $_POST['locality_id'];
    $district_id   = $_POST['district_id'];
    $client_id     = $_POST['client_id'];
    $user_id       = $_REQUEST['user_id'];
    $room_adress   = trim(strip_tags($_POST['adress_room']));
    $room_level    = $_POST['level_room'];
    $room_num      = $_POST['num_room'];
    $room_square   = $_POST['sq_room'];
    $room_destript = trim(strip_tags($_POST['room_info']));
    $room_price    = $_POST['price_room'];

    if (isset($_REQUEST['status_room'])) {
        $room_status = $_REQUEST['status_room'];
    }

    if (isset($_REQUEST['update_rooms'])) {
        if ($_SESSION['user_data']['user_stat'] == 'user') {

            $sql = mysqli_query($connect, "UPDATE `rooms` SET `locality_id` = '{$locality_id}', `district_id`= '{$district_id}', `client_id` = '{$client_id}', `room_adress` = '{$room_adress}', `room_level` = '{$room_level}', `room_num` = '{$room_num}', `room_square` = '{$room_square}', `room_descript` = '{$room_destript}', `room_price` = '{$room_price}', `room_status` = '{$room_status}' WHERE `room_id` = '{$_REQUEST['room_id']}' AND `user_id` = '{$_SESSION['user_data']['user_id']}'");

            for ($i = 0; $i < 2; $i++) {

                if (strstr($_FILES['room_img']['type'][$i], 'image') != false) {

                    $file_img = addslashes(file_get_contents($_FILES['room_img']['tmp_name'][$i]));
                    unlink($_FILES['room_img']['tmp_name'][$i]);
                    $room_img_query = mysqli_query($connect, "INSERT INTO `room_images` (`img`, `room_id`) VALUES ('{$file_img}','{$_REQUEST['room_id']}')");
                }
            }
        } else {
            $sql = mysqli_query($connect, "UPDATE `rooms` SET `locality_id` = '{$locality_id}', `district_id`= '{$district_id}', `client_id` = '{$client_id}', `user_id` = '{$user_id}', `room_adress` = '{$room_adress}', `room_level` = '{$room_level}', `room_num` = '{$room_num}', `room_square` = '{$room_square}', `room_descript` = '{$room_destript}', `room_price` = '{$room_price}', `room_status` = '{$room_status}' WHERE `room_id` = '{$_REQUEST['room_id']}'");

            for ($i = 0; $i < 2; $i++) {

                if (strstr($_FILES['room_img']['type'][$i], 'image') != false) {

                    $file_img = addslashes(file_get_contents($_FILES['room_img']['tmp_name'][$i]));
                    unlink($_FILES['room_img']['tmp_name'][$i]);
                    $room_img_query = mysqli_query($connect, "INSERT INTO `room_images` (`img`, `room_id`) VALUES ('{$file_img}','{$_REQUEST['room_id']}')");
                }
            }
        }
        mysqli_close($connect);
    }
}

function updateHouse($connect)
{
    $locality_id    = $_POST['locality_id'];
    $district_id    = $_POST['district_id'];
    $client_id      = $_POST['client_id'];
    $house_adress   = trim(strip_tags($_POST['house_adress']));
    $user_id        = $_REQUEST['user_id'];
    $house_area     = $_POST['house_area'];
    $house_land     = $_POST['house_land'];
    $house_destript = trim(strip_tags($_POST['house_info']));
    $house_price    = $_POST['price_house'];

    if (isset($_REQUEST['status_house'])) {
        $house_status = $_REQUEST['status_house'];
    }

    if (isset($_REQUEST['update_houses'])) {
        if ($_SESSION['user_data']['user_stat'] == 'user') {

            $sql_house = mysqli_query($connect, "UPDATE `houses` SET `locality_id` = '{$locality_id}', `district_id` = '{$district_id}', `client_id` = '{$client_id}', `house_adress` = '{$house_adress}', `house_area` = '{$house_area}', `house_land` = '{$house_land}', `house_descript` = '{$house_destript}', `house_price` = '{$house_price}', `house_status` = '{$house_status}' WHERE `house_id` = '{$_REQUEST['house_id']}' AND `user_id` = '{$_SESSION['user_data']['user_id']}'");

            for ($i = 0; $i < 2; $i++) {

                if (strstr($_FILES['house_img']['type'][$i], 'image') != false) {

                    $file_img = addslashes(file_get_contents($_FILES['house_img']['tmp_name'][$i]));
                    unlink($_FILES['house_img']['tmp_name'][$i]);
                    $house_img_query = mysqli_query($connect, "INSERT INTO  `house_images` (img, house_id) VALUES ('{$file_img}','{$_REQUEST['house_id']}')");
                }
            }
        } else {
            $sql_house = mysqli_query($connect, "UPDATE `houses` SET `locality_id` = '{$locality_id}', `district_id` = '{$district_id}', `client_id` = '{$client_id}', `user_id` = '{$user_id}', `house_adress` = '{$house_adress}', `house_area` = '{$house_area}', `house_land` = '{$house_land}', `house_descript` = '{$house_destript}', `house_price` = '{$house_price}', `house_status` = '{$house_status}' WHERE `house_id` = '{$_REQUEST['house_id']}'");

            for ($i = 0; $i < 2; $i++) {

                if (strstr($_FILES['house_img']['type'][$i], 'image') != false) {

                    $file_img = addslashes(file_get_contents($_FILES['house_img']['tmp_name'][$i]));
                    unlink($_FILES['house_img']['tmp_name'][$i]);
                    $house_img_query = mysqli_query($connect, "INSERT INTO  `house_images` (img, house_id) VALUES ('{$file_img}','{$_REQUEST['house_id']}')");
                }
            }
        }
        mysqli_close($connect);
    }

}

function updateLand($connect)
{
    $locality_id   = $_POST['locality_id'];
    $district_id   = $_POST['district_id'];
    $client_id     = $_POST['client_id'];
    $user_id       = $_REQUEST['user_id'];
    $land_adress   = trim(strip_tags($_POST['land_adress']));
    $land_area     = $_POST['land_area'];
    $land_descript = trim(strip_tags($_POST['land_info']));
    $land_price    = $_POST['price_land'];

    if (isset($_REQUEST['status_land'])) {
        $land_status = $_REQUEST['status_land'];
    }

    if (isset($_REQUEST['update_lands'])) {
        if ($_SESSION['user_data']['user_stat'] == 'user') {

            $land_update_query = mysqli_query($connect, "UPDATE `lands` SET `locality_id`='{$locality_id}' ,`district_id`='{$district_id}' ,`client_id`='{$client_id}' ,`land_adress`='{$land_adress}' ,`land_area`='{$land_area}' ,`land_descript`='{$land_descript}' ,`land_price`='{$land_price}' ,`land_status`='{$land_status}' WHERE `land_id`='{$_REQUEST['land_id']}' AND `user_id` = '{$_SESSION['user_data']['user_id']}'");

            for ($i = 0; $i < 2; $i++) {

                if (strstr($_FILES['land_img']['type'][$i], 'image') != false) {

                    $file_img = addslashes(file_get_contents($_FILES['land_img']['tmp_name'][$i]));
                    unlink($_FILES['land_img']['tmp_name'][$i]);
                    $land_img_query = mysqli_query($connect, "INSERT INTO  `land_images` (`img`, `land_id`) VALUES ('{$file_img}','{$_REQUEST['land_id']}')");
                }
            }
        } else {
            $land_update_query = mysqli_query($connect, "UPDATE `lands` SET `locality_id`='{$locality_id}' ,`district_id`='{$district_id}' ,`client_id`='{$client_id}' , `user_id` = '{$user_id}', `land_adress`='{$land_adress}' ,`land_area`='{$land_area}' ,`land_descript`='{$land_descript}' ,`land_price`='{$land_price}' ,`land_status`='{$land_status}' WHERE `land_id`='{$_REQUEST['land_id']}'");

            for ($i = 0; $i < 2; $i++) {

                if (strstr($_FILES['land_img']['type'][$i], 'image') != false) {

                    $file_img = addslashes(file_get_contents($_FILES['land_img']['tmp_name'][$i]));
                    unlink($_FILES['land_img']['tmp_name'][$i]);
                    $land_img_query = mysqli_query($connect, "INSERT INTO  `land_images` (`img`, `land_id`) VALUES ('{$file_img}','{$_REQUEST['land_id']}')");
                }
            }
        }
        mysqli_close($connect);
    }
}

function updateClient($connect)
{
    $fname_cl         = trim(strip_tags($_POST['fname']));
    $name1            = trim(strip_tags($_POST['name1']));
    $name2            = trim(strip_tags($_POST['name2']));
    $pass_num         = trim(strip_tags($_POST['pass_num']));
    $pass_code        = trim(strip_tags($_POST['pass_code']));
    $pass_date        = trim(strip_tags($_POST['pass_date']));
    $pass_iss         = trim(strip_tags($_POST['pass_iss']));
    $user_id          = $_REQUEST['user_id'];
    $adress_reg       = trim(strip_tags($_POST['adress_reg']));
    $client_telephone = trim(strip_tags($_POST['client_telephone']));
    $client_email     = trim(htmlspecialchars($_POST['client_email']));
    $client_info      = trim(strip_tags($_POST['client_info']));

    if (isset($_REQUEST['update_clients'])) {
        if ($_SESSION['user_data']['user_stat'] == 'user') {
            $client_update_query = mysqli_query($connect, "UPDATE `clients` SET `fname_cl`='{$fname_cl}', `name1`='{$name1}', `name2`='{$name2}', `pass_num`='{$pass_num}', `pass_code`='{$pass_code}', `pass_date`='{$pass_date}', `pass_iss`='{$pass_iss}', `adress_reg`='$adress_reg', `client_telephone`='{$client_telephone}', `email`='{$client_email}', `client_info`='{$client_info}' WHERE `client_id`='{$_REQUEST['client_id']}' AND `user_id` = '{$_SESSION['user_data']['user_id']}'");
        } else {
            $client_update_query = mysqli_query($connect, "UPDATE `clients` SET `user_id` = '{$user_id}', `fname_cl`='{$fname_cl}', `name1`='{$name1}', `name2`='{$name2}', `pass_num`='{$pass_num}', `pass_code`='{$pass_code}', `pass_date`='{$pass_date}', `pass_iss`='{$pass_iss}', `adress_reg`='$adress_reg', `client_telephone`='{$client_telephone}', `email`='{$client_email}', `client_info`='{$client_info}' WHERE `client_id`='{$_REQUEST['client_id']}'");
        }
        mysqli_close($connect);
    }
}

function updateUser($connect)
{
    $fname     = trim(strip_tags($_REQUEST['fname']));
    $name      = trim(strip_tags($_REQUEST['name']));
    $telephone = trim(strip_tags($_REQUEST['user_telephone']));
    $login     = trim(strip_tags($_REQUEST['user_login']));
    $pass      = password_hash(trim(strip_tags($_REQUEST['user_pass'])), PASSWORD_DEFAULT);

    if (isset($_REQUEST['update_user'])) {
        $user_udate_query = mysqli_query($connect, "UPDATE `users` SET `fname` = '{$fname}', `name` = '{$name}', `telephon` = '{$telephone}', `user_login` = '{$login}', `user_pass` = '{$pass}' WHERE `user_id` = '{$_REQUEST['user_id']}'");
        mysqli_close($connect);
    }
}
