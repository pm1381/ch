<?php
define('HOST_NAME', 'localhost');
define('DOMAIN', "");
define('DRIVER', "mysql");
define('BASE_URI', 'http://localhost/project/ch/home');
define('ORIGIN', 'http://localhost');

//---mongo database---//
define('MONGO_DB_NAME', '');

//---mysql database---//
define('DB_NAME', 'charand');
define('USERNAME', 'root');
define('PASSWORD', '');

//---statics---//
define('ROOT', "");
define('SRC', ROOT . 'src' . DIRECTORY_SEPARATOR);
define('TEMPLATE', SRC . 'Views' . DIRECTORY_SEPARATOR);
define('ADMIN_TEMPLATE', TEMPLATE . 'admin' . DIRECTORY_SEPARATOR);
define('MODEL', SRC . 'Models' . DIRECTORY_SEPARATOR);
define('ROUTER', SRC . 'Routers' . DIRECTORY_SEPARATOR);
define('LIBRARY', SRC . 'Libs' . DIRECTORY_SEPARATOR);
define('CONFIG', SRC . 'Configs' . DIRECTORY_SEPARATOR);
define('POLICY', SRC . 'Policies' . DIRECTORY_SEPARATOR);
define('PROVIDER', SRC . 'Providers' . DIRECTORY_SEPARATOR);
define('CONTROLLER', SRC . 'Controllers' . DIRECTORY_SEPARATOR);
define('SITE_CONTROLLER', CONTROLLER . 'Site' . DIRECTORY_SEPARATOR);
define('ADMIN_CONTROLLER', CONTROLLER . 'Admin' . DIRECTORY_SEPARATOR);
define('REFRENCE_CONTROLLER', CONTROLLER . 'Refrence' . DIRECTORY_SEPARATOR);
define("CONTROLLER_NAMESPACE", "App\Controllers");
define('STORAGE', BASE . "\\" . 'storage' . DIRECTORY_SEPARATOR);

// and adding all files from library floder
require LIBRARY . 'Function.php';
