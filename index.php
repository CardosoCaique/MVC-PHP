<?php
    require __DIR__.'/vendor/autoload.php';

    use App\Http\Router;
    use App\Controller\Utils\View;

    define("URL", 'http://127.0.0.1:8000');

    View::init([
        'URL' => URL
    ]);

    $route = new Router(URL);

    include __DIR__.'/routes/web.php';

    $route->run()->sendResponse();
