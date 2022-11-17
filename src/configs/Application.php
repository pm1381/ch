<?php

    use App\Database\Database;
    use App\Helpers\Tools;
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;

    // other whoops handlers:
    // $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    // $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);
    
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\CallbackHandler(function($error) {
        $baseLogger = new Logger('base');
        $baseLogger->pushHandler(new StreamHandler(Tools::slashToBackSlash(STORAGE . "log/base.log")));
        $baseLogger->error(" *message : " . $error->getMessage() . " *File : " . $error->getFile() . " *Line : " . $error->getLine());
        var_dump($error);
    }));
    $whoops->register();


    $action = Tools::getUrl();
    $mysqldatabase = new Database;
    $mysqldatabase->addMysqlConnection();

    

    require_once 'src/routers/web.php';
    require_once 'src/routers/api.php';
