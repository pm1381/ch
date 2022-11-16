<?php
define("VACANT", "");
define("DIRECTORY_SEPRATOR", "/");
define("BACKSLASH", "\\");
define('ROOT', VACANT);
define('SRC', ROOT . 'src' . DIRECTORY_SEPRATOR);
define('TEMPLATE', SRC . 'Views' . DIRECTORY_SEPRATOR);
define('ADMIN_TEMPLATE', TEMPLATE . 'admin' . DIRECTORY_SEPRATOR);
define('MODEL', SRC . 'Models' . DIRECTORY_SEPRATOR);
define('LIBRARY', SRC . 'Libs' . DIRECTORY_SEPRATOR);
define('CONFIG', SRC . 'Configs' . DIRECTORY_SEPRATOR);
define('CONTROLLER', SRC . 'Controllers' . DIRECTORY_SEPRATOR);
define('SITE_CONTROLLER', CONTROLLER . 'Site' . DIRECTORY_SEPRATOR);
define('ADMIN_CONTROLLER', CONTROLLER . 'Admin' . DIRECTORY_SEPRATOR);
define('REFRENCE_CONTROLLER', CONTROLLER . 'Refrence' . DIRECTORY_SEPRATOR);
define('STORAGE', BASE . BACKSLASH . 'storage' . DIRECTORY_SEPRATOR);
define("CONTROLLER_NAMESPACE", "App\Controllers");

// and adding all files from library floder
require_once LIBRARY . 'Function.php';
