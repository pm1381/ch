<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Tehran");

define('HOST_NAME', 'localhost');
define('DOMAIN', "");
define('DRIVER', "mysql");
define('BASE_URI', 'http://localhost/project/ch');
define('ORIGIN', 'http://localhost');

//---mongo database---//
define('MONGO_DB_NAME', '');

//---mysql database---//
define('DB_NAME', 'charand');
define('USERNAME', 'root');
define('PASSWORD', '');

//---statics---//
define("VACANT", "");
define("DIRECTORY_SEPRATOR", "/");
define("BACKSLASH", "\\");
define('ROOT', VACANT);
define('SRC', ROOT . 'src' . DIRECTORY_SEPRATOR);
define('TEMPLATE', SRC . 'Views' . DIRECTORY_SEPRATOR);
define('ADMIN_TEMPLATE', TEMPLATE . 'admin' . DIRECTORY_SEPRATOR);
define('MODEL', SRC . 'Models' . DIRECTORY_SEPRATOR);
define('ROUTER', SRC . 'Routers' . DIRECTORY_SEPRATOR);
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

require 'src/configs/Application.php';