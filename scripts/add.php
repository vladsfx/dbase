<?php

include_once 'database_connect.php';

function addClient($connect)
{
    $fname_cl         = trim(strip_tags($_POST['fname']));
    $name1            = trim(strip_tags($_POST['name1']));
    $name2            = trim(strip_tags($_POST['name2']));
    $pass_num         = trim(strip_tags($_POST['pass_num']));
    $pass_code        = trim(strip_tags($_POST['pass_code']));
    $pass_date        = trim(strip_tags($_POST['pass_date']));
    $pass_iss         = trim(strip_tags($_POST['pass_iss']));
    $adress_reg       = trim(strip_tags($_POST['adress_reg']));
    $client_telephone = trim(strip_tags($_POST['client_telephone']));
    $client_email     = trim(htmlspecialchars($_POST['client_email']));
    $client_info      = trim(strip_tags($_POST['client_info']));
    $client_data_reg  = date('Y-m-d H:i:s');
    $user_id          = $_SESSION['user_data']['user_id'];

    if ((isset($_POST['entry_clients'])) && (isset($_POST['fname'])) && (isset($_POST['name1']))) {

        $new_client_query = "INSERT INTO `clients`(client_id,user_id,fname_cl,name1,name2,pass_num,pass_code,pass_date,pass_iss,adress_reg,client_telephone,email,client_info,client_data_reg) VALUES (NULL,'" . $user_id . "','" . $fname_cl . "','" . $name1 . "','" . $name2 . "','" . $pass_num . "','" . $pass_code . "','" . $pass_date . "','" . $pass_iss . "','" . $adress_reg . "','" . $client_telephone . "','" . $client_email . "','" . $client_info . "','" . $client_data_reg . "')";

        $result_client_query = mysqli_query($connect, $new_client_query);
        header('Location: clients');
    }
    mysqli_close($connect);
}

function addRoom($connect)
{
    $locality_id   = $_POST['locality_id'];
    $district_id   = $_POST['district_id'];
    $client_id     = $_POST['client_id'];
    $user_id       = $_SESSION['user_data']['user_id'];
    $room_adress   = trim(strip_tags($_POST['adress_room']));
    $room_level    = $_POST['level_room'];
    $room_num      = $_POST['num_room'];
    $room_square   = $_POST['sq_room'];
    $room_destrict = trim(strip_tags($_POST['room_info']));
    $room_price    = $_POST['price_room'];
    $room_data_reg = date('Y-m-d H:i:s');
    $room_status   = 'Зарегистрирован';

    if (isset($_POST['entry_rooms'])) {

        $new_room_query = "INSERT INTO `rooms`(room_id,locality_id,district_id,client_id,user_id,room_adress,room_level,room_num,room_square,room_descript,room_price,room_data_reg,room_status) VALUES (NULL,'" . $locality_id . "','" . $district_id . "','" . $client_id . "','" . $user_id . "','" . $room_adress . "','" . $room_level . "','" . $room_num . "','" . $room_square . "','" . $room_destrict . "','" . $room_price . "','" . $room_data_reg . "','" . $room_status . "')";

        $result_room_query = mysqli_query($connect, $new_room_query);
        $last_id           = mysqli_insert_id($connect);

        for ($i = 0; $i < 6; $i++) {

            if (strstr($_FILES['room_img']['type'][$i], 'image') != false) {

                $file_img = addslashes(file_get_contents($_FILES['room_img']['tmp_name'][$i]));
                unlink($_FILES['room_img']['tmp_name'][$i]);
                $room_img_query = "INSERT INTO `room_images` (img, room_id) VALUES ('$file_img','$last_id')";
                $result_img     = mysqli_query($connect, $room_img_query);
            }
        }
        mysqli_close($connect);
    }
}

function addHouse($connect)
{
    $locality_id    = $_POST['locality_id'];
    $district_id    = $_POST['district_id'];
    $client_id      = $_POST['client_id'];
    $user_id        = $_SESSION['user_data']['user_id'];
    $house_adress   = trim(strip_tags($_POST['house_adress']));
    $house_area     = $_POST['house_area'];
    $house_land     = $_POST['house_land'];
    $house_destrict = trim(strip_tags($_POST['house_info']));
    $house_price    = $_POST['price_house'];
    $house_data_reg = date('Y-m-d H:i:s');
    $house_status   = 'Зарегистрирован';

    if (isset($_POST['entry_houses'])) {

        $new_house_query = "INSERT INTO `houses`(house_id,locality_id,district_id,client_id,user_id,house_adress,house_area,house_land,house_descript,house_price,house_data_reg,house_status) VALUES (NULL,'" . $locality_id . "','" . $district_id . "','" . $client_id . "','" . $user_id . "','" . $house_adress . "','" . $house_area . "','" . $house_land . "','" . $house_destrict . "','" . $house_price . "','" . $house_data_reg . "','" . $house_status . "')";

        $result_home_query = mysqli_query($connect, $new_house_query);
        $last_id           = mysqli_insert_id($connect);

        for ($i = 0; $i < 6; $i++) {

            if (strstr($_FILES['house_img']['type'][$i], 'image') != false) {

                $file_img = addslashes(file_get_contents($_FILES['house_img']['tmp_name'][$i]));
                unlink($_FILES['house_img']['tmp_name'][$i]);
                $house_img_query = "INSERT INTO  `house_images` (img, house_id) VALUES ('$file_img','$last_id')";
                $result_img      = mysqli_query($connect, $house_img_query);
            }
        }
        mysqli_close($connect);
    }
}

function addLand($connect)
{
    $locality_id   = $_POST['locality_id'];
    $district_id   = $_POST['district_id'];
    $client_id     = $_POST['client_id'];
    $user_id       = $_SESSION['user_data']['user_id'];
    $land_adress   = trim(strip_tags($_POST['land_adress']));
    $land_area     = $_POST['land_area'];
    $land_descript = trim(strip_tags($_POST['land_info']));
    $land_price    = $_POST['price_land'];
    $land_data_reg = date('Y-m-d H:i:s');
    $land_status   = 'Зарегистрирован';

    if (isset($_POST['entry_lands'])) {

        $new_land_query = "INSERT INTO `lands`(land_id,locality_id,district_id,client_id,user_id,land_adress,land_area,land_descript,land_price,land_data_reg,land_status) VALUES (NULL,'" . $locality_id . "','" . $district_id . "','" . $client_id . "','" . $user_id . "','" . $land_adress . "','" . $land_area . "','" . $land_descript . "','" . $land_price . "','" . $land_data_reg . "','" . $land_status . "')";

        $result_land_query = mysqli_query($connect, $new_land_query);
        $last_id           = mysqli_insert_id($connect);

        for ($i = 0; $i < 4; $i++) {

            if (strstr($_FILES['land_img']['type'][$i], 'image') != false) {

                $file_img = addslashes(file_get_contents($_FILES['land_img']['tmp_name'][$i]));
                unlink($_FILES['land_img']['tmp_name'][$i]);
                $land_img_query = "INSERT INTO  `land_images` (img, land_id) VALUES ('$file_img','$last_id')";
                $result_img     = mysqli_query($connect, $land_img_query);
            }
        }
        mysqli_close($connect);
    }
}
