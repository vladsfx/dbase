<?php

function ses_destroy()
{
    $_SESSION = [];
    $_POST['link'] = null;
    $_POST = null;
    unset($_COOKIE[session_name()]);
    session_destroy();
}

//-------------------------------------
if (!empty($_POST['link']) and $_POST['link'] === 'exit') {
    header('Location: ../index');
    $sql = mysqli_query($connect, "UPDATE `users` SET `online` = '' WHERE `user_id` = '{$_SESSION['user_data']['user_id']}'");
    ses_destroy();
}

//-------------------------------------
if (isset($_POST['entry_client'])) {
    header('Location: form_client_insert');
} elseif (isset($_POST['entry_clients'])) {
    header('Location: clients');
} elseif (isset($_POST['update_clients'])) {
    header('Location: clients_once?client_id=' . $_REQUEST['client_id']);
} elseif (isset($_POST['del_client'])) {
    header('Location: clients');
} elseif (isset($_POST['entry_room'])) {
    header('Location: form_room_insert');
} elseif (isset($_POST['entry_rooms'])) {
    header('Location: room');
} elseif (isset($_POST['update_rooms'])) {
    header('Location: room_once?room_id=' . $_REQUEST['room_id']);
} elseif (isset($_POST['del_room'])) {
    header('Location: room');
} elseif (isset($_POST['entry_house'])) {
    header('Location: form_house_insert');
} elseif (isset($_POST['entry_houses'])) {
    header('Location: house');
} elseif (isset($_POST['update_houses'])) {
    header('Location: house_once?house_id=' . $_REQUEST['house_id']);
} elseif (isset($_POST['del_house'])) {
    header('Location: house');
} elseif (isset($_POST['entry_land'])) {
    header('Location: form_land_insert');
} elseif (isset($_POST['entry_lands'])) {
    header('Location: lands');
} elseif (isset($_POST['update_lands'])) {
    header('Location: lands_once?land_id=' . $_REQUEST['land_id']);
} elseif (isset($_POST['del_land'])) {
    header('Location: lands');
} elseif (isset($_POST['update_users'])) {
    header('Location: form_user_update?user_id=' . $_REQUEST['user_id']);
} elseif (isset($_POST['update_user'])) {
    header('Location: users');
} elseif (isset($_POST['del_users'])) {
    header('Location: users');
} elseif (isset($_POST['cancel'])) {
    header('Location: /');
} elseif (isset($_POST['new_user'])) {
    header('Location: /');
}

//-------------------------------------
function month_ru($month)
{
    if ($month === 'January') {
        $month = 'января';
    } elseif ($month === 'February') {
        $month = 'февраля';
    } elseif ($month === 'March') {
        $month = 'марта';
    } elseif ($month === 'April') {
        $month = 'апреля';
    } elseif ($month === 'May') {
        $month = 'мая';
    } elseif ($month === 'June') {
        $month = 'июня';
    } elseif ($month === 'July') {
        $month = 'июля';
    } elseif ($month === 'August') {
        $month = 'августа';
    } elseif ($month === 'September') {
        $month = 'сентября';
    } elseif ($month === 'October') {
        $month = 'октября';
    } elseif ($month === 'November') {
        $month = 'ноября';
    } elseif ($month === 'December') {
        $month = 'декабря';
    }

    return $month;
}

function nav_user()
{
    if (!empty($_SESSION['user_data']['user_stat']) and $_SESSION['user_data']['user_stat'] == 'admin') {
        echo '
        <nav>
            <div class="nav">
                <ul>
                    <li><a href="/user_page/room">Квартиры</a></li>
                    <li><a href="/user_page/house">Дома</a></li>
                    <li><a href="/user_page/lands">Участки</a></li>
                    <li><a href="/user_page/clients">Клиенты</a></li>
                    <li><a href="/user_page/users">Сотрудники</a></li>
                </ul>
            </div>
        </nav>
        ';
    } else {
        echo '
        <nav>
            <div class="nav">
                <ul>
                    <li><a href="/user_page/room">Квартиры</a></li>
                    <li><a href="/user_page/house">Дома</a></li>
                    <li><a href="/user_page/lands">Участки</a></li>
                    <li><a href="/user_page/clients">Клиенты</a></li>
                </ul>
            </div>
        </nav>
        ';
    }
}

function colorStat($stat)
{
    if ($stat == 'Зарегистрирован') {
        return "green";
    } elseif ($stat == 'Отложен') {
        return "blue";
    } elseif ($stat == 'Продан') {
        return "red";
    }
}
