<?php
    namespace App\Controller\Utils;

    class View
    {
        /**
        * Método responsável por retornar o conteúdo de uma view
        * @param string $view
        * @return string
        */
        private static function getContentView($view)
        {
            $file = __DIR__.'/../../../resources/views/'.$view.'.html';
            $viewPageNotFound = __DIR__.'/../../../resources/views/http/404.html';

            return file_exists($file) ? file_get_contents($file) : file_get_contents($viewPageNotFound);
        }
        /**
        * Método responsável por retornar o conteúdo renderizado de uma view
        * @param string $view
        * @return string
        */
        public static function render($view)
        {
            //CONTEÚDO DA VIEW
            $contentView = self::getContentView($view);
            return $contentView;
        }
    }
