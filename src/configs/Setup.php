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

//---mail---//
define('MAIL_MAILER', "smtp");
define('MAIL_HOST', "smtp.mailtrap.io");
define('MAIL_PORT', 2525);
define('MAIL_USERNAME', "71c82a6e3b0ef2");
define('MAIL_PASSWORD', "397c00c8664212");
define('MAIL_ENCRYPTION', null);
define('MAIL_FROM_ADDRESS', "parham.minou@gmail.com");
define('MAIL_FROM_NAME', "parham simple framework");

//---statics---//
define('SRC', 'src' . DIRECTORY_SEPARATOR);
define('PUBLIC_FOLDER', 'public' . DIRECTORY_SEPARATOR);
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
define('VIEW', SRC . 'views' . DIRECTORY_SEPARATOR);
define('SITE_VIEW', VIEW . 'site' . DIRECTORY_SEPARATOR);
define('ADMIN_VIEW', VIEW . 'admin' . DIRECTORY_SEPARATOR);
define("CONTROLLER_NAMESPACE", "App\Controllers");
define('STORAGE', BASE . "\\" . 'storage' . DIRECTORY_SEPARATOR);

// and adding all files from library floder
require LIBRARY . 'Function.php';
