<?php
    namespace App\Http;
    /**
     *
     */
    class Request
    {
        /**
         * Método Http da requisição
         * @var  string
         */
        private $httpMethod;

        /**
         * URI (rota) da página
         * @var  string
         */
        private $uri;

        /**
         * Parametros da URL($_GET)
         * @var  array
         */
        private $queryParams = [];

        /**
         * Variáveis recebidas no POST da página ($_POST)
         * @var  array
         */
        private $postVars = [];

        /**
         * Cabeçalho da requisição
         * @var  array
         */

        private $headers = [];

        public function __construct()
        {
            $this->queryParams  = $_GET ?? [];
            $this->postVars     = $_POST ?? [];
            $this->headers      = getallheaders();
            $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? '';
            $this->uri          = $_SERVER['REQUEST_URI'] ?? '';
        }

        /**
         *  Método que retorna o método de Requisição (GET, POST...)
         * @return  string
         */
        public function getHttpMethod()
        {
            return $this->httpMethod;
        }
        /**
        *  Método que retorna o método a URI
        * @return  string
        */
        public function getHttpUri()
        {
           return $this->uri;
        }

        /**
         *  Método que retorna o Cabeçalho
         * @return  string
         */
        public function getHeaders()
        {
           return $this->headers;
        }

        /**
         *  Método que retorna os parêmatros da url
         * @return array
         */
        public function getQueryParams()
        {
           return $this->queryParams;
        }

        /**
         *  Método que retorna as variáveis Post
         * @return array
         */
        public function getPostVars()
        {
           return $this->postVars;
        }
    }
