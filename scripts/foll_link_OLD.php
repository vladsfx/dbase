<?php

include_once 'database_connect.php';

//вставка данных клиента на странице "Клиент"
function linkClient($connect)
{
    $cl_query = "SELECT * FROM `clients`
LEFT JOIN
`users` ON
clients.user_id = users.user_id
WHERE client_id = '" . $_REQUEST['client_id'] . "'";

    $cl_arr = mysqli_query($connect, $cl_query);
    $row    = mysqli_fetch_assoc($cl_arr);

    if ((isset($_REQUEST['client_id'])) && ($_REQUEST['client_id'] == $row['client_id'])) {

        echo '
			<table id="once">
				<tr>
				<td><b>Ф.И.О.:</b></td><td><b>' . $row['fname_cl'] . '</b>&nbsp;<b>' . $row['name1'] . '</b>&nbsp;<b>' . $row['name2'] . '</b></td>
				</tr>
				<tr>
					<td><b>Номер паспорта:</b></td><td>' . $row['pass_num'] . '</td>
				</tr>
				<tr>
					<td><b>Код паспорта:</b></td><td>' . $row['pass_code'] . '</td>
				</tr>
				<tr>
					<td><b>Дата выдачи паспорта:</b></td><td>' . $row['pass_date'] . '</td>
				</tr>
				<tr>
					<td><b>Кем выдан:</b></td><td>' . $row['pass_iss'] . '</td>
				</tr>
				<tr>
					<td><b>Адрес регистрации:</b></td><td>' . $row['adress_reg'] . '</td>
				</tr>
				<tr>';
        if ($_SESSION['user_data']['user_stat'] == 'user') {
            $client_query_us = "SELECT client_telephone FROM `clients`
											WHERE user_id = '" . $_SESSION['user_data']['user_id'] . "'";
            $client_arr_us = mysqli_query($connect, $client_query_us);
            $row_us_cl     = mysqli_fetch_assoc($client_arr_us);
            $telephone     = $row_us_cl['client_telephone'];
        } else {
            $telephone = $row['client_telephone'];
        }
        echo '<td><b>Телефон:</b></td><td><b>+7' . $telephone . '</b></td>

        		</tr>
				<tr>
					<td><b>Email:</b></td><td>' . $row['email'] . '</td>
				</tr>
				<tr>
					<td><b>Дата регистрации:</b></td><td>' . date('d ', strtotime($row['client_data_reg'])) . month_ru(date('F', strtotime($row['client_data_reg']))) . date(' Y', strtotime($row['client_data_reg'])) . ' г.</td>
				</tr>
				<tr>
				<td><b>Куратор:</b></td><td style="font-weight: bold; color: red;">' . $row['fname'] . '&nbsp;' . $row['name'] . '</td>
				</tr>
				<tr>
					<td><b>Дополнительная информация:</b></td></tr>
			</table>

			<div id="dicr">
				<section>
					<p>' . $row['client_info'] . '</p>
				</section>

			</div>
';
    }
    mysqli_close($connect);
}

//Вставка данных квартиры на странице "Квартира"
function linkRoom($connect)
{
    $room_query = "SELECT * FROM `rooms`
LEFT JOIN
`users` ON
rooms.user_id = users.user_id
LEFT JOIN
`clients` ON
rooms.client_id = clients.client_id
LEFT JOIN
`districts` ON
rooms.district_id = districts.district_id
LEFT JOIN
`locality` ON
rooms.locality_id = locality.locality_id
WHERE `room_id` = '" . $_REQUEST['room_id'] . "'";

    $room_arr = mysqli_query($connect, $room_query);
    $row      = mysqli_fetch_assoc($room_arr);

    if ((isset($_REQUEST['room_id'])) && ($_REQUEST['room_id'] == $row['room_id'])) {

        $room_price = number_format($row['room_price'], 0, '.', ' ');

        echo '
        <table id="once">
				<tr>
					<td><b>Населенный пункт:</b></td><td>' . $row['local'] . '</td>
				</tr>
				<tr>
					<td><b>Район:</b></td><td>' . $row['distr'] . '</td>
				</tr>
				<tr>
					<td><b>Адрес:</b></td><td>
						<div id="click1">
						<a href="javascript:change_visibility (\'click1\', \'click2\')">Адрес квартиры</a>
						</div>
						<div id="click2" style="display:none">
			    			<a href="#" onClick="change_visibility (\'click2\', \'click1\')">' . $row['room_adress'] . '</a>
						</div>
					</td>
				</tr>
				<tr>
					<td><b>Этаж:</b></td><td>' . $row['room_level'] . '</td>
				</tr>
				<tr>
					<td><b>Кол-во комнат:</b></td><td>' . $row['room_num'] . '</td>
				</tr>
				<tr>
					<td><b>Площадь:</b></td><td>' . $row['room_square'] . '&nbsp;кв.м</td>
				</tr>
				<tr>
				<td><b>Собственник:</b></td><td><b>' . $row['fname_cl'] . '&nbsp;' . $row['name1'] . '&nbsp;' . $row['name2'] . '</b></td>
				</tr>
				<tr>
					<td><b>Куратор:</b></td><td style="font-weight: bold; color: red;">' . $row['fname'] . '&nbsp;' . $row['name'] . '</td>
				</tr>
				<tr>
					<td><b>Дата публикации:</b></td><td>' . date('d ', strtotime($row['room_data_reg'])) . month_ru(date('F', strtotime($row['room_data_reg']))) . date(' Y', strtotime($row['room_data_reg'])) . ' г.</td>
				</tr>
				<tr>
				<td><b>Телефон:</b></td>';
        if ($_SESSION['user_data']['user_stat'] == 'user') {
            $room_query_us = "SELECT client_telephone FROM `rooms`, `clients`
										WHERE rooms.client_id = clients.client_id
										AND `room_id` = '" . $_REQUEST['room_id'] . "'
										AND rooms.user_id = '" . $_SESSION['user_data']['user_id'] . "'";
            $room_arr_us = mysqli_query($connect, $room_query_us);
            $row_us      = mysqli_fetch_assoc($room_arr_us);
            $telephone   = $row_us['client_telephone'];
        } else {
            $telephone = $row['client_telephone'];
        }
        echo '<td><div id="r0">
						<a href="javascript:change_visibility (\'r0\', \'r1\')"><b>Номер телефона</b></a>
					</div>
					<div id="r1" style="display:none">
		    			<a href="#" onClick="change_visibility (\'r1\', \'r0\')"><b>+7' . $telephone . '</b></a>
					</div></td>
        		</tr>
				<tr>
					<td><b>Цена:</b></td><td style="font-weight: bold; color: red;">' . $room_price . '&nbsp;руб.</td>
				</tr>
				<tr>
				<td><b>Статус:</b></td><td style="font-weight: bold; color: ' . colorStat($row['room_status']) . ';">' . $row['room_status'] . '</td>
				</tr>
				<tr>
					<td><b>Дополнительная информация:</b></td>
				</tr>
			</table>

			<div id="dicr">
				<section>
					<p>' . $row['room_descript'] . '</p>
				</section>
			</div>';
    }

    $img_room_query = "SELECT * FROM `room_images` WHERE room_id = '" . $_REQUEST['room_id'] . "'";
    $img_room_arr   = mysqli_query($connect, $img_room_query);

    echo '	<div class="sl_ctr">
			<div class="sldr">  ';
    while ($img_result = mysqli_fetch_assoc($img_room_arr)) {
        $img = base64_encode($img_result['img']);
        echo '<img src="data:img/jpeg;base64, ' . $img . '" alt="Фото" height="300">';
    }
    echo '	</div>
        	<div class="prv_b"></div>
			<div class="nxt_b"></div>
			</div>';
    mysqli_close($connect);
}

// Вставка данных дом на странице "Дом"

function linkHouse($connect)
{
    $house_query = "SELECT * FROM `houses`
LEFT JOIN
`users` ON
houses.user_id = users.user_id
LEFT JOIN
`clients` ON
houses.client_id = clients.client_id
LEFT JOIN
`districts` ON
houses.district_id = districts.district_id
LEFT JOIN
`locality` ON
houses.locality_id = locality.locality_id
WHERE house_id = '" . $_REQUEST['house_id'] . "'";

    $house_arr = mysqli_query($connect, $house_query);
    $row       = mysqli_fetch_assoc($house_arr);

    if ((isset($_REQUEST['house_id'])) && ($_REQUEST['house_id'] == $row['house_id'])) {

        $house_price = number_format($row['house_price'], 0, '.', ' ');

        echo '
        <table id="once">
				<tr>
					<td><b>Населенный пункт:</b></td><td>' . $row['local'] . '</td>
				</tr>
				<tr>
					<td><b>Район:</b></td><td>' . $row['distr'] . '</td>
				</tr>
				<tr>
					<td><b>Адрес:</b></td><td>
						<div id="click1">
						<a href="javascript:change_visibility (\'click1\', \'click2\')">Адрес дома</a>
						</div>
						<div id="click2" style="display:none">
			    			<a href="#" onClick="change_visibility (\'click2\', \'click1\')">' . $row['house_adress'] . '</a>
						</div>
					</td>
				</tr>
				<tr>
					<td><b>Площадь дома:</b></td><td>' . $row['house_area'] . ' кв.м.</td>
				</tr>
				<tr>
					<td><b>Площадь участка:</b></td><td>' . $row['house_land'] . ' сот.</td>
				</tr>
				<tr>
				<td><b>Собственник:</b></td><td><b>' . $row['fname_cl'] . '&nbsp;' . $row['name1'] . '&nbsp;' . $row['name2'] . '</b></td>
				</tr>
				<tr>
					<td><b>Куратор:</b></td><td>' . $row['fname'] . '&nbsp;' . $row['name'] . '</td>
				</tr>
				<tr>
					<td><b>Дата публикации:</b></td><td>' . date('d ', strtotime($row['house_data_reg'])) . month_ru(date('F', strtotime($row['house_data_reg']))) . date(' Y', strtotime($row['house_data_reg'])) . ' г.</td>
				</tr>
				<tr>
				<td><b>Телефон:</b></td>';
        if ($_SESSION['user_data']['user_stat'] == 'user') {
            $house_query_us = "SELECT client_telephone FROM `houses`, `clients`
										WHERE houses.client_id = clients.client_id
										AND `house_id` = '" . $_REQUEST['house_id'] . "'
										AND houses.user_id = '" . $_SESSION['user_data']['user_id'] . "'";
            $house_arr_us = mysqli_query($connect, $house_query_us);
            $row_us_house = mysqli_fetch_assoc($house_arr_us);
            $telephone    = $row_us_house['client_telephone'];
        } else {
            $telephone = $row['client_telephone'];
        }

        echo '<td><div id="r0">
						<a href="javascript:change_visibility (\'r0\', \'r1\')"><b>Номер телефона</b></a>
					</div>
					<div id="r1" style="display:none">
		    			<a href="#" onClick="change_visibility (\'r1\', \'r0\')"><b>+7' . $telephone . '</b></a>
					</div></td>
				</tr>
				<tr>
					<td><b>Цена:</b></td><td style="font-weight: bold; color: red;">' . $house_price . '&nbsp;руб.</td>
				</tr>
				<tr>
					<td><b>Статус:</b></td><td style="font-weight: bold; color: ' . colorStat($row['house_status']) . ';">' . $row['house_status'] . '</td>
				</tr>
				<tr>
					<td><b>Дополнительная информация:</b></td>
				</tr>
			</table>

			<div id="dicr_house">
				<section>
					<p>' . $row['house_descript'] . '</p>
				</section>
			</div>';
    }

    $img_house_query = "SELECT * FROM `house_images` WHERE house_id = '" . $_REQUEST['house_id'] . "'";
    $img_house_arr   = mysqli_query($connect, $img_house_query);

    echo '	<div class="sl_ctr">
				<div class="sldr">  ';
    while ($img_result = mysqli_fetch_assoc($img_house_arr)) {
        $img = base64_encode($img_result['img']);
        echo '<img src="data:img/jpeg;base64, ' . $img . '" alt="Фото" height="300">';
    }
    echo '	</div>
        		<div class="prv_b"></div>
				<div class="nxt_b"></div>
				</div>';
    mysqli_close($connect);
}

// Вставка данных о земельном участке на странице "Участок"
function linkLand($connect)
{
    $land_query = "SELECT * FROM `lands`
LEFT JOIN
`users` ON
lands.user_id = users.user_id
LEFT JOIN
`clients` ON
lands.client_id = clients.client_id
LEFT JOIN
`districts` ON
lands.district_id = districts.district_id
LEFT JOIN
`locality` ON
lands.locality_id = locality.locality_id
WHERE land_id = '" . $_REQUEST['land_id'] . "'";

    $land_arr = mysqli_query($connect, $land_query);
    $row      = mysqli_fetch_assoc($land_arr);

    if ((isset($_REQUEST['land_id'])) && ($_REQUEST['land_id'] == $row['land_id'])) {

        $land_price = number_format($row['land_price'], 0, '.', ' ');

        echo '
        <table id="once">
				<tr>
					<td><b>Населенный пункт:</b></td><td>' . $row['local'] . '</td>
				</tr>
				<tr>
					<td><b>Район:</b></td><td>' . $row['distr'] . '</td>
				</tr>
				<tr>
					<td><b>Адрес:</b></td><td>
						<div id="click1">
						<a href="javascript:change_visibility (\'click1\', \'click2\')">Адрес участка</a>
						</div>
						<div id="click2" style="display:none">
			    			<a href="#" onClick="change_visibility (\'click2\', \'click1\')">' . $row['land_adress'] . '</a>
						</div>
					</td>
				</tr>

				<tr>
					<td><b>Площадь участка:</b></td><td>' . $row['land_area'] . ' сот.</td>
				</tr>
				<tr>
				<td><b>Собственник:</b></td><td><b>' . $row['fname_cl'] . '&nbsp;' . $row['name1'] . '&nbsp;' . $row['name2'] . '</b></td>
				</tr>
				<tr>
					<td><b>Куратор:</b></td><td style="font-weight: bold; color: red;">' . $row['fname'] . '&nbsp;' . $row['name'] . '</td>
				</tr>
				<tr>
					<td><b>Дата публикации:</b></td><td>' . date('d ', strtotime($row['land_data_reg'])) . month_ru(date('F', strtotime($row['land_data_reg']))) . date(' Y', strtotime($row['land_data_reg'])) . ' г.</td>
				</tr>
				<tr>
				<td><b>Телефон:</b></td>';
        if ($_SESSION['user_data']['user_stat'] == 'user') {
            $land_query_us = "SELECT client_telephone FROM `lands`, `clients`
										WHERE lands.client_id = clients.client_id
										AND `land_id` = '" . $_REQUEST['room_id'] . "'
										AND lands.user_id = '" . $_SESSION['user_data']['user_id'] . "'";
            $land_arr_us = mysqli_query($connect, $land_query_us);
            $row_us_land = mysqli_fetch_assoc($land_arr_us);
            $telephone   = $row_us_land['client_telephone'];
        } else {
            $telephone = $row['client_telephone'];
        }
        echo '<td><div id="r0">
						<a href="javascript:change_visibility (\'r0\', \'r1\')"><b>Номер телефона</b></a>
					</div>
					<div id="r1" style="display:none">
		    			<a href="#" onClick="change_visibility (\'r1\', \'r0\')"><b>+7' . $telephone . '</b></a>
					</div></td>
				</tr>
				<tr>
					<td><b>Цена:</b></td><td style="font-weight: bold; color: red;">' . $land_price . '&nbsp;руб.</td>
				</tr>
				<tr>
					<td><b>Статус:</b></td><td style="font-weight: bold; color: ' . colorStat($row['land_status']) . ';">' . $row['land_status'] . '</td>
				</tr>
				</table>
			<div id="dicr_land">
			<p><b>Дополнительная информация:</b></p>
				<section>
					<p>' . $row['land_descript'] . '</p>
				</section>
			</div>';
    }

    $img_land_query = "SELECT * FROM `land_images` WHERE land_id = '" . $_REQUEST['land_id'] . "'";
    $img_land_arr   = mysqli_query($connect, $img_land_query);

    echo '	<div class="sl_ctr">
				<div class="sldr">  ';
    while ($img_result = mysqli_fetch_assoc($img_land_arr)) {
        $img = base64_encode($img_result['img']);
        echo '<img src="data:img/jpeg;base64, ' . $img . '" alt="Фото" height="300">';
    }
    echo '	</div>
        		<div class="prv_b"></div>
				<div class="nxt_b"></div>
				</div>';
    mysqli_close($connect);
}
