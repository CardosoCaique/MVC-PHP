<?php
    namespace App\Controller\Utils;

    class View
    {
        static $viewPageNotFound = __DIR__.'/../../../resources/views/http/404.html';

        /**
        * Método responsável por retornar o conteúdo de uma view
        * @param string $view
        * @return string
        */
        private static function getContentView($view)
        {
            $file = __DIR__.'/../../../resources/views/'.$view.'.html';
            return file_exists($file) ? file_get_contents($file) : file_get_contents(self::$viewPageNotFound);
        }
        /**
        * Método responsável por retornar o conteúdo renderizado de uma view
        * @param string $view
        * @param array $vars(string/numeric)
        * @return string
        */
        public static function render($view, $vars = [])
        {
            $contentView = self::getContentView($view);

            $keys = array_keys($vars);

            $keys = array_map(function($item) {
                return '{{ '.$item.' }}';
            }, $keys);

            return str_replace($keys, array_values($vars), $contentView);
        }

        public static function pageNotFound()
        {
            return file_get_contents(self::$viewPageNotFound);
        }
    }
