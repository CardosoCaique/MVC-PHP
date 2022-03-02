<?php
    require __DIR__.'/vendor/autoload.php';

    use App\Http\Router;
    use App\Http\Response;
    use App\Controller\Pages\HomeController;

    define("URL", 'http://127.0.0.1:8000');

    $ob = new Router(URL);
    //home
    $ob->get('/', [
        function() {
            return new Response(200, HomeController::getHome());
        }
    ]);

    $ob->run()->sendResponse();
