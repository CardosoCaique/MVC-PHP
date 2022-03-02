<?php
    require __DIR__.'/vendor/autoload.php';

    use App\Controller\Pages\HomeController;

    use App\Http\Response;
    $ob = new \App\Http\Response(200, 'Olá mundo');

    $ob->sendResponse();
    exit;
    echo HomeController::getHome();
