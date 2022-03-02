<?php
    namespace App\Controller\Pages;
    use App\Controller\Utils\View;
    use App\Model\Entity\Organization;

    class HomeController extends PagesController
    {
        /**
        * Método responsável por retornar o conteúdo da Home
        * @return string
        */
        public static function getHome()
        {
            $organization = new Organization();

            $content = View::render('pages/home', [
                'name' => $organization->name,
            ]);

            return parent::getPage('Home', $content);
        }
    }
