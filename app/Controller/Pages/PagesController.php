<?php
    namespace App\Controller\Pages;
    use App\Controller\Utils\View;

    class PagesController
    {
        /**
        * Método responsável por retornar o conteúdo do Header
        * @return string
        */
        private static function getHeader()
        {
            return  View::render('layouts/header');
        }

        /**
        * Método responsável por retornar o conteúdo do Footer
        * @return string
        */
        private static function getFooter()
        {
            return  View::render('layouts/footer');
        }

        /**
        * Método responsável por retornar o conteúdo do Layout
        * @return string
        */
        public static function getPage($title, $content = '')
        {
            return View::render('layouts/layout', [
                'header' => self::getHeader(),
                'footer' => self::getFooter(),
                'content' => $content,
                'title' => 'Home'
            ]);
        }
    }
