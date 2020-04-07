<?php

// Форма выборки клиентов
function searchClient($connect) //Вывод списка клиентов на странице "Клиенты"

{
    if (isset($_REQUEST['search_cl']) and $_SESSION['user_data']['user_stat'] == 'admin') {
        $query = "SELECT * FROM `clients`
        WHERE
        `fname_cl` = '{$_REQUEST['fname']}'
        OR
        `name1` = '{$_REQUEST['name1']}'
        OR
        `name2` = '{$_REQUEST['name2']}'
        ORDER BY `client_id` DESC";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {

            echo "
<a href='/user_page/clients_once.php?client_id=" . $value['client_id'] . "'>
<div class='form_clients'>
    <article>
        <table>
            <tr>
        <td>" . $value['fname_cl'] . "</td>
        <td>" . $value['name1'] . "</td>
        <td>" . $value['name2'] . "</td>
        <td>" . date('d ', strtotime($value['client_data_reg'])) . month_ru(date('F', strtotime($value['client_data_reg']))) . date(' Y', strtotime($value['client_data_reg'])) . "</td>";
            echo "<td>+7" . $value['client_telephone'] . "</td>
            </tr>
        </table>
    </article>
</div>
</a>
";
        }
    } elseif (isset($_REQUEST['search_admin'])) {
        $query = "SELECT * FROM `clients`
        WHERE
        `user_id` = '{$_REQUEST['user_id']}'
        ORDER BY `client_id` DESC";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {

            echo "
<a href='/user_page/clients_once.php?client_id=" . $value['client_id'] . "'>
<div class='form_clients'>
    <article>
        <table>
            <tr>
        <td>" . $value['fname_cl'] . "</td>
        <td>" . $value['name1'] . "</td>
        <td>" . $value['name2'] . "</td>
        <td>" . date('d ', strtotime($value['client_data_reg'])) . month_ru(date('F', strtotime($value['client_data_reg']))) . date(' Y', strtotime($value['client_data_reg'])) . "</td>";
            echo "<td>+7" . $value['client_telephone'] . "</td>
            </tr>
        </table>
    </article>
</div>
</a>
";
        }
    } elseif ($_SESSION['user_data']['user_stat'] == 'user') {
        $query = "SELECT * FROM `clients`
        WHERE `user_id` = '{$_SESSION['user_data']['user_id']}'";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {

            echo "
<a href='/user_page/clients_once.php?client_id=" . $value['client_id'] . "'>
<div class='form_clients'>
    <article>
        <table>
            <tr>
        <td>" . $value['fname_cl'] . "</td>
        <td>" . $value['name1'] . "</td>
        <td>" . $value['name2'] . "</td>
        <td>" . date('d ', strtotime($value['client_data_reg'])) . month_ru(date('F', strtotime($value['client_data_reg']))) . date(' Y', strtotime($value['client_data_reg'])) . "</td>
        <td>+7" . $value['client_telephone'] . "</td>
            </tr>
        </table>
    </article>
</div>
</a>
";
        }
    } else {
        $query  = "SELECT * FROM `clients` ORDER BY `client_id` DESC";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {

            echo "
<a href='/user_page/clients_once.php?client_id=" . $value['client_id'] . "'>
<div class='form_clients'>
    <article>
        <table>
            <tr>
        <td>" . $value['fname_cl'] . "</td>
        <td>" . $value['name1'] . "</td>
        <td>" . $value['name2'] . "</td>
        <td>" . date('d ', strtotime($value['client_data_reg'])) . month_ru(date('F', strtotime($value['client_data_reg']))) . date(' Y', strtotime($value['client_data_reg'])) . "</td>
        <td>+7" . $value['client_telephone'] . "</td>
            </tr>
        </table>
    </article>
</div>
</a>
";
        }
    }
    mysqli_close($connect);
}

// Поиск квартир ------------------------------------------
function searchRoom($connect)
{
    if (isset($_POST['room_search'])) {

        $query = "SELECT * FROM `rooms`
    LEFT JOIN `locality` ON
    rooms.locality_id=locality.locality_id
    LEFT JOIN `districts` ON
    rooms.district_id=districts.district_id
    WHERE
    rooms.locality_id='" . $_POST['local'] . "'
    AND
    rooms.district_id='" . $_POST['distr'] . "'
    OR
    room_level='" . $_POST['lavel'] . "'
    OR
    room_num='" . $_POST['room_num'] . "'
    OR
    (room_price BETWEEN  '" . $_POST['bottom'] . "'
    AND '" . $_POST['top'] . "')";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM room_images WHERE room_id='" . $value['room_id'] . "' GROUP BY img HAVING count(Id_img)=1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $room_price = number_format($value['room_price'], 0, '.', ' ');

            echo "
<a href='/user_page/room_once?room_id=" . $value['room_id'] . "'>
<div class='form_obj'>
    <form action=''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото квартиры'>
        <div id='bl-1'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-2'>
            <p><b>Этаж: </b>" . $value['room_level'] . "</p><br>
            <p><b>Кол-во комнат: </b>" . $value['room_num'] . "</p>
        </div>
        <div id='bl-3'>
            <p><b>Площадь: </b>" . $value['room_square'] . " кв.м</p><br>
            <p><b>Cтатус: <font color='" . colorStat($value['room_status']) . "'>" . $value['room_status'] . "</font></b></p>
        </div>
        <div id='bl-4'>
            <p><b>Цена: <i>" . $room_price . " руб.</i></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } elseif (isset($_REQUEST['search_admin'])) {

        $query = "SELECT * FROM `rooms`
    LEFT JOIN `locality` ON
    rooms.locality_id=locality.locality_id
    LEFT JOIN `districts` ON
    rooms.district_id=districts.district_id
    WHERE
    `user_id` = '{$_REQUEST['user_id']}'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM room_images WHERE room_id='" . $value['room_id'] . "' GROUP BY img HAVING count(Id_img)=1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $room_price = number_format($value['room_price'], 0, '.', ' ');

            echo "
<a href='/user_page/room_once?room_id=" . $value['room_id'] . "'>
<div class='form_obj'>
    <form action=''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото квартиры'>
        <div id='bl-1'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-2'>
            <p><b>Этаж: </b>" . $value['room_level'] . "</p><br>
            <p><b>Кол-во комнат: </b>" . $value['room_num'] . "</p>
        </div>
        <div id='bl-3'>
            <p><b>Площадь: </b>" . $value['room_square'] . " кв.м</p><br>
            <p><b>Cтатус: <font color='" . colorStat($value['room_status']) . "'>" . $value['room_status'] . "</font></b></p>
        </div>
        <div id='bl-4'>
            <p><b>Цена: <i>" . $room_price . " руб.</i></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } elseif (isset($_REQUEST['search_user'])) {

        $query = "SELECT * FROM `rooms`
    LEFT JOIN `locality` ON
    rooms.locality_id=locality.locality_id
    LEFT JOIN `districts` ON
    rooms.district_id=districts.district_id
    WHERE
    `user_id` = '{$_SESSION['user_data']['user_id']}'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM room_images WHERE room_id='" . $value['room_id'] . "' GROUP BY img HAVING count(Id_img)=1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $room_price = number_format($value['room_price'], 0, '.', ' ');

            echo "
<a href='/user_page/room_once?room_id=" . $value['room_id'] . "'>
<div class='form_obj'>
    <form action=''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото квартиры'>
        <div id='bl-1'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-2'>
            <p><b>Этаж: </b>" . $value['room_level'] . "</p><br>
            <p><b>Кол-во комнат: </b>" . $value['room_num'] . "</p>
        </div>
        <div id='bl-3'>
            <p><b>Площадь: </b>" . $value['room_square'] . " кв.м</p><br>
            <p><b>Cтатус: <font color='" . colorStat($value['room_status']) . "'>" . $value['room_status'] . "</font></b></p>
        </div>
        <div id='bl-4'>
            <p><b>Цена: <i>" . $room_price . " руб.</i></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } else {
        $query = "SELECT * FROM rooms
    LEFT JOIN locality ON
    rooms.locality_id=locality.locality_id
    LEFT JOIN districts ON
    rooms.district_id=districts.district_id
    ORDER BY room_id DESC";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM room_images WHERE room_id='" . $value['room_id'] . "' GROUP BY img HAVING count(Id_img)=1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $room_price = number_format($value['room_price'], 0, '.', ' ');

            echo "
<a href='/user_page/room_once?room_id=" . $value['room_id'] . "'>
<div class='form_obj'>
	<form action=''>
    <img src='data:img/jpeg;base64, " . $img . "' alt='Фото квартиры'>
		<div id='bl-1'>
			<p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
			<p><b>Район: </b>" . $value['distr'] . "</p>
		</div>
		<div id='bl-2'>
			<p><b>Этаж: </b>" . $value['room_level'] . "</p><br>
			<p><b>Кол-во комнат: </b>" . $value['room_num'] . "</p>
		</div>
		<div id='bl-3'>
			<p><b>Площадь: </b>" . $value['room_square'] . " кв.м</p><br>
			<p><b>Cтатус: <font color='" . colorStat($value['room_status']) . "'>" . $value['room_status'] . "</font></b></p>
		</div>
		<div id='bl-4'>
			<p><b>Цена: <i>" . $room_price . " руб.</i></b></p>
		</div>
	</form>
    </div>
</a>
";
        }
    }
    // mysqli_close($connect);
}

//-------------------------------------------------------------------------------------------
function searhHouse($connect)
{
    if (isset($_POST['house_search'])) {

        $query = "SELECT * FROM houses
    LEFT JOIN locality ON
    houses.locality_id=locality.locality_id
    LEFT JOIN districts ON
    houses.district_id=districts.district_id
    WHERE
    houses.locality_id='" . $_POST['local'] . "'
    AND
    houses.district_id='" . $_POST['distr'] . "'
    OR
    house_area <='" . $_POST['house_area'] . "'
    OR
    house_land <='" . $_POST['house_land'] . "'
    OR
    (house_price BETWEEN  '" . $_POST['bottom'] . "'
    AND '" . $_POST['top'] . "')";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM house_images WHERE house_id ='" . $value['house_id'] . "' GROUP BY img HAVING count(Id_img) = 1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $house_price = number_format($value['house_price'], 0, '.', ' ');

            echo "
<a href='/user_page/house_once?house_id=" . $value['house_id'] . "'>
<div class ='form_obj'>
    <form action =''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото дома'>
        <div id='bl-1'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-2'>
            <p><b>Площадь дома: </b>" . $value['house_area'] . " кв.м</p><br>
            <p><b>Площадь участка </b>" . $value['house_land'] . " сот.</p>
        </div>
        <div id='bl-3'>
            <p><b>Цена: <i>" . $house_price . " руб.</i></b></p><br>
            <p><b>Cтатус: <font color='" . colorStat($value['house_status']) . "'>" . $value['house_status'] . "</font></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } elseif (isset($_POST['search_admin'])) {

        $query = "SELECT * FROM houses
    LEFT JOIN locality ON
    houses.locality_id=locality.locality_id
    LEFT JOIN districts ON
    houses.district_id=districts.district_id
    WHERE
    `user_id` = '{$_REQUEST['user_id']}'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM house_images WHERE house_id ='" . $value['house_id'] . "' GROUP BY img HAVING count(Id_img) = 1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $house_price = number_format($value['house_price'], 0, '.', ' ');

            echo "
<a href='/user_page/house_once?house_id=" . $value['house_id'] . "'>
<div class ='form_obj'>
    <form action =''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото дома'>
        <div id='bl-1'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-2'>
            <p><b>Площадь дома: </b>" . $value['house_area'] . " кв.м</p><br>
            <p><b>Площадь участка </b>" . $value['house_land'] . " сот.</p>
        </div>
        <div id='bl-3'>
            <p><b>Цена: <i>" . $house_price . " руб.</i></b></p><br>
            <p><b>Cтатус: <font color='" . colorStat($value['house_status']) . "'>" . $value['house_status'] . "</font></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } elseif (isset($_POST['search_user'])) {

        $query = "SELECT * FROM houses
    LEFT JOIN locality ON
    houses.locality_id=locality.locality_id
    LEFT JOIN districts ON
    houses.district_id=districts.district_id
    WHERE
    `user_id` = '{$_SESSION['user_data']['user_id']}'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM house_images WHERE house_id ='" . $value['house_id'] . "' GROUP BY img HAVING count(Id_img) = 1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $house_price = number_format($value['house_price'], 0, '.', ' ');

            echo "
<a href='/user_page/house_once?house_id=" . $value['house_id'] . "'>
<div class ='form_obj'>
    <form action =''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото дома'>
        <div id='bl-1'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-2'>
            <p><b>Площадь дома: </b>" . $value['house_area'] . " кв.м</p><br>
            <p><b>Площадь участка </b>" . $value['house_land'] . " сот.</p>
        </div>
        <div id='bl-3'>
            <p><b>Цена: <i>" . $house_price . " руб.</i></b></p><br>
            <p><b>Cтатус: <font color='" . colorStat($value['house_status']) . "'>" . $value['house_status'] . "</font></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } else {
        $query = "SELECT * FROM `houses`
    LEFT JOIN `locality` ON
    houses.locality_id=locality.locality_id
    LEFT JOIN `districts` ON
    houses.district_id=districts.district_id
    ORDER BY house_id DESC";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM house_images WHERE house_id ='" . $value['house_id'] . "' GROUP BY img HAVING count(Id_img) = 1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $house_price = number_format($value['house_price'], 0, '.', ' ');

            echo "
<a href='/user_page/house_once?house_id=" . $value['house_id'] . "'>
<div class ='form_obj'>
    <form action =''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото дома'>
        <div id='bl-1'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-2'>
            <p><b>Площадь дома: </b>" . $value['house_area'] . " кв.м</p><br>
            <p><b>Площадь участка: </b>" . $value['house_land'] . " сот.</p>
        </div>
        <div id='bl-3'>
            <p><b>Цена: <i>" . $house_price . " руб.</i></b></p><br>
            <p><b>Cтатус: <font color='" . colorStat($value['house_status']) . "'>" . $value['house_status'] . "</font></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    }
    // mysqli_close($connect);
}

// Поиск земельных участков-------------------------------------------------
function searchLands($connect)
{
    if (isset($_POST['lands_search'])) {

        $query = "SELECT * FROM lands
    LEFT JOIN locality ON
    lands.locality_id=locality.locality_id
    LEFT JOIN districts ON
    lands.district_id=districts.district_id
    WHERE
    lands.locality_id='" . $_POST['local'] . "'
    AND
    lands.district_id='" . $_POST['distr'] . "'
    OR
    land_area <='" . $_POST['land_area'] . "'
    OR
    (land_price BETWEEN  '" . $_POST['bottom'] . "'
    AND '" . $_POST['top'] . "')";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM land_images WHERE land_id ='" . $value['land_id'] . "' GROUP BY img HAVING count(Id_img) = 1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $land_price = number_format($value['land_price'], 0, '.', ' ');

            echo "
<a href='/user_page/lands_once?land_id=" . $value['land_id'] . "'>
<div class ='form_obj'>
    <form action =''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото участка'>
        <div id='bl-2'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-3'>
            <p><b>Площадь: </b>" . $value['land_area'] . " сот.</p><br>
             <p><b>Cтатус: <font color='" . colorStat($value['land_status']) . "'>" . $value['land_status'] . "</font></b></p>
        </div>
        <div id='bl-4'>
            <p><b>Цена: <i>" . $land_price . " руб.</i></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } elseif (isset($_POST['search_admin'])) {

        $query = "SELECT * FROM lands
    LEFT JOIN locality ON
    lands.locality_id=locality.locality_id
    LEFT JOIN districts ON
    lands.district_id=districts.district_id
    WHERE
    `user_id` = '{$_REQUEST['user_id']}'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM land_images WHERE land_id ='" . $value['land_id'] . "' GROUP BY img HAVING count(Id_img) = 1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $land_price = number_format($value['land_price'], 0, '.', ' ');

            echo "
<a href='/user_page/lands_once?land_id=" . $value['land_id'] . "'>
<div class ='form_obj'>
    <form action =''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото участка'>
        <div id='bl-2'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-3'>
            <p><b>Площадь: </b>" . $value['land_area'] . " сот.</p><br>
             <p><b>Cтатус: <font color='" . colorStat($value['land_status']) . "'>" . $value['land_status'] . "</font></b></p>
        </div>
        <div id='bl-4'>
            <p><b>Цена: <i>" . $land_price . " руб.</i></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } elseif (isset($_POST['search_user'])) {

        $query = "SELECT * FROM lands
    LEFT JOIN locality ON
    lands.locality_id=locality.locality_id
    LEFT JOIN districts ON
    lands.district_id=districts.district_id
    WHERE
    `user_id` = '{$_SESSION['user_data']['user_id']}'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM land_images WHERE land_id ='" . $value['land_id'] . "' GROUP BY img HAVING count(Id_img) = 1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $land_price = number_format($value['land_price'], 0, '.', ' ');

            echo "
<a href='/user_page/lands_once?land_id=" . $value['land_id'] . "'>
<div class ='form_obj'>
    <form action =''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото участка'>
        <div id='bl-2'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-3'>
            <p><b>Площадь: </b>" . $value['land_area'] . " сот.</p><br>
             <p><b>Cтатус: <font color='" . colorStat($value['land_status']) . "'>" . $value['land_status'] . "</font></b></p>
        </div>
        <div id='bl-4'>
            <p><b>Цена: <i>" . $land_price . " руб.</i></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    } else {
        $query = "SELECT * FROM lands
    LEFT JOIN locality ON
    lands.locality_id=locality.locality_id
    LEFT JOIN districts ON
    lands.district_id=districts.district_id
    ORDER BY land_id DESC";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $value) {
            $query_img  = "SELECT img, count(id) AS Id_img FROM `land_images` WHERE land_id ='" . $value['land_id'] . "' GROUP BY img HAVING count(Id_img) = 1";
            $result_img = mysqli_query($connect, $query_img);
            $img_arrey  = mysqli_fetch_assoc($result_img);
            $img        = base64_encode($img_arrey['img']);

            $land_price = number_format($value['land_price'], 0, '.', ' ');

            echo "
<a href='/user_page/lands_once?land_id=" . $value['land_id'] . "'>
<div class ='form_obj'>
    <form action =''>
        <img src='data:img/jpeg;base64, " . $img . "' alt='Фото участка'>
        <div id='bl-2'>
            <p><b>Нас. пункт: </b>" . $value['local'] . "</p><br>
            <p><b>Район: </b>" . $value['distr'] . "</p>
        </div>
        <div id='bl-3'>
            <p><b>Площадь: </b>" . $value['land_area'] . " сот.</p><br>
            <p><b>Cтатус: <font color='" . colorStat($value['land_status']) . "'>" . $value['land_status'] . "</font></b></p>
        </div>
        <div id='bl-4'>
            <p><b>Цена: <i>" . $land_price . " руб.</i></b></p>
        </div>
    </form>
</div>
</a>
";
        }
    }
    // mysqli_close($connect);
}
