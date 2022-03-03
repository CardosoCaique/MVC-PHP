<?php
    use App\Http\Response;
    use App\Controller\Pages;

    $route->get('/', [
        function() {
            return new Response(200, Pages\HomeController::getHome());
        }
    ]);

    $route->get('/sobre', [
        function() {
            return new Response(200, Pages\HomeController::getAbout());
        }
    ]);

    $route->get('/pagina/{id}/{action}', [
        function($id, $action) {
            return new Response(200, 'Página '.$id.' - '.$action);
        }
    ]);
