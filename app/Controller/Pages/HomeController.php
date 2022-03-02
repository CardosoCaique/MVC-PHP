<?php
    namespace App\Controller\Pages;
    use App\Controller\Utils\View;

    class HomeController
    {
        /**
        * Método responsável por retornar o conteúdo da Home
        * @return string
        */
        public static function getHome()
        {
            return View::render('pages/home');
        }
    }
