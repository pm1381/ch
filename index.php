<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Tehran");
define("BASE", __DIR__);
require BASE . '/vendor/autoload.php';

require BASE . '/src/configs/Setup.php';

//nex step : JOB & QUEUEE;


//hint : 
// Entity: An entity represents a single instance of your domain object saved into the database as a record. 
// It has some attributes that we represent as columns in our tables.

//model it is our repository which is connceted to databse and the sqls will be in here

//contoller means buisiness part

//view is presentation

//we used MVC structure and for more information and checking the truth . please check laravel9 framework


// so repository means models folder
// and data means entity folder
