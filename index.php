<?php

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once 'scripts/database_scripts.php';
include_once 'scripts/main_scripts.php';

user_login($connect);

include_once 'content/head.php';
include_once 'content/header.php';

include_once 'register/page_enter.php';

include_once 'content/footer.php';
