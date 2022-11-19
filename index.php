<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
define("BASE", __DIR__);
date_default_timezone_set("Asia/Tehran");

require __DIR__ . '/vendor/autoload.php';
require 'src/configs/Setup.php';
require 'src/configs/Application.php';