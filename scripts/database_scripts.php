<?php

// session_start();

include_once 'database_connect.php';

//Добавление нового пользователя-------------------------------------------------------------------------
function user_reg($connect)
{
    $new_user_fname = trim(strip_tags($_POST['new_fname']));
    $new_user_name = trim(strip_tags($_POST['new_name']));
    $new_user_telephone = trim(strip_tags($_POST['new_telephone']));
    $new_user_login = trim(strip_tags($_POST['new_login']));
    $new_user_pass = password_hash(trim(strip_tags($_POST['new_pass'])), PASSWORD_DEFAULT);
    $log_admin = trim(strip_tags($_POST['log_admin']));
    $pass_admin = trim(strip_tags($_POST['pass_admin']));
    $new_user_date = date('Y-m-d H:i:s');

    if (isset($_POST['reg_admin'])) {
        $new_user_stat = 'admin';
    } else {
        $new_user_stat = 'user';
    }

    if (isset($_POST['new_user'])) {
        $user_query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users` WHERE `user_login` = '{$log_admin}'"));

        if (($log_admin == $user_query['user_login']) && (password_verify($pass_admin, $user_query['user_pass']) && ($user_query['user_stat'] == 'admin'))) {
            $check_query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE user_login = '{$new_user_login}'"));

            if (!isset($check_query['user_login'])) {
                $new_user_query = mysqli_query($connect, "INSERT INTO `users` (fname, name, telephon, user_login, user_pass, user_stat, user_data_reg, online, last_visit) VALUES ('{$new_user_fname}', '{$new_user_name}', '{$new_user_telephone}', '{$new_user_login}', '{$new_user_pass}', '{$new_user_stat}', '{$new_user_date}', ' ', '2020-01-01 01:01:01')");
            }
        }
    }
    mysqli_close($connect);
}

//Регистрация пользователя----------------------------------------------------------------------
function user_login($connect)
{
    if ((isset($_POST['login_user'])) && (isset($_POST['login'])) && (isset($_POST['pass']))) {
        $user_login = trim(strip_tags($_POST['login']));
        $user_pass = trim(strip_tags($_POST['pass']));

        $login_query = "SELECT * FROM users WHERE user_login = '" . $user_login . "'";
        $result_arr = mysqli_fetch_assoc(mysqli_query($connect, $login_query));

        $user_login_db = $result_arr['user_login'];
        $user_pass_db = $result_arr['user_pass'];

        if (isset($result_arr['user_login'])) {
            if (($user_login === $user_login_db) && (password_verify($user_pass, $user_pass_db))) {
                $_SESSION['user_data']['user_id'] = $result_arr['user_id'];
                $_SESSION['user_data']['user_login'] = $result_arr['user_login'];
                $_SESSION['user_data']['user_name'] = $result_arr['name'];
                $_SESSION['user_data']['user_stat'] = $result_arr['user_stat'];
                $last_user_date = date('Y-m-d H:i:s');
                header('Location: user_page/room');
                $sql = mysqli_query($connect, "UPDATE `users` SET `online` = 'В сети', `last_visit` = '{$last_user_date}' WHERE `user_id` = '{$result_arr['user_id']}'");
            } else {
                echo "<script>alert(\"Введённые логин или пароль не верны. Попробуйте ещё раз.\");</script>";
            }
        } else {
            echo "<script>alert(\"Введите действующие пароль и логин!\");</script>";
        }
        mysqli_close($connect);
    }
}

//Вывод списка населенных пунктов-----------------------------------------------------
function listLocality($connect)
{
    $local_query = "SELECT * FROM `locality`";
    $local_arr = mysqli_query($connect, $local_query);

    while ($row = mysqli_fetch_assoc($local_arr)) {

        echo "<option value='" . $row['locality_id'] . "'>" . $row['local'] . "</option>";
    }
}

//Вывод списка районов------------------------------------------------------------------
function listDistricts($connect)
{
    $distr_query = "SELECT * FROM  `districts`";
    $distr_arr = mysqli_query($connect, $distr_query);

    while ($row = mysqli_fetch_assoc($distr_arr)) {

        echo "<option value='" . $row['district_id'] . "'>" . $row['distr'] . "</option>";
    }
}

function listClients($connect)
{
    if ($_SESSION['user_data']['user_stat'] == 'user') {
        $clients_query = "SELECT * FROM  `clients` WHERE `user_id` = '{$_SESSION['user_data']['user_id']}'";
        $clients_arr = mysqli_query($connect, $clients_query);

        while ($row = mysqli_fetch_assoc($clients_arr)) {

            echo "<option value='" . $row['client_id'] . "'>" . $row['fname_cl'] . "&nbsp;" . $row['name1'] . "&nbsp;" . $row['name2'] . " </option>";
        }
    } else {
        $clients_query = "SELECT * FROM  `clients`";
        $clients_arr = mysqli_query($connect, $clients_query);

        while ($row = mysqli_fetch_assoc($clients_arr)) {

            echo "<option value='" . $row['client_id'] . "'>" . $row['fname_cl'] . "&nbsp;" . $row['name1'] . "&nbsp;" . $row['name2'] . " </option>";
        }
    }
}

function listUser($connect)
{
    $user_query = "SELECT * FROM  `users`";
    $user_arr = mysqli_query($connect, $user_query);

    while ($row = mysqli_fetch_assoc($user_arr)) {

        echo "<option value='" . $row['user_id'] . "'>" . $row['fname'] . "&nbsp;" . $row['name'] . "</option>";
    }
}
