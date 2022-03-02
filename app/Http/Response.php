<?php
    namespace App\Http;
    /**
     *
     */
    class Response
    {
        /**
         * Código do status HTTP
         * @var integer
         */
        private $httpCode = 200;

        /**
         * Cabeçalho da resposta
         * @var array
         */
        private $headers = [];

        /**
         * tipo de conteúdo retornado
         * @var string
         */
        private $contentType = 'text/html';

        /**
         * contedúdo da resposta
         * @var mixed
         */
        private $content ;

        public function __construct($httpCode, $content, $contentType = 'text/html')
        {
            $this->httpCode = $httpCode;
            $this->content = $content;
            $this->setContentType($contentType);
        }

        /**
        * Método responsável por alterar o contentType do response
        * @param string
        */
        public function setContentType($contentType)
        {
            $this->contentType = $contentType;
            $this->addHeader('Content-Type', $contentType);
        }

        /**
        * Método responsável por adicionar um registro ao cabeçalho de resposta
        * @param string
        */
        public function addHeader($key, $value)
        {
            $this->headers[$key] = $value;
        }

        /*
         * Método responsável por enviar os Headers para o navegador
        */
        private function sendHeaders()
        {
            //STATUS
            http_response_code($this->httpCode);

            //ENVIAR HEADERS
            foreach ($this->headers as $key => $value) {
                header($key.': '.$value);
            }
        }

        /**
        * Método responsável por enviar a reposta para o usuário
        */
        public function sendResponse()
        {
            $this->sendHeaders();
            switch($this->contentType){
                case 'text/html':
                    echo $this->content;
            }
        }
    }
