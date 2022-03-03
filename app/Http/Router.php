<?php
    namespace App\Http;

    use \Closure;
    use \Exception;
    use \ReflectionFunction;
    use App\Controller\Utils\View;

    class Router
    {
        /**
         * URL completa (Raíz)
         * @var string
         */
        private $url = '';

        /**
         *  Prefixo de todas as rotas
         * @var string
         */
        private $prefix = '';

        /**
         * Rotas
         * @var array
         */
        private $routes = [];

        /**
         * Instância de Resquest
         * @var Request
         */
        private $request;

        public function __construct($url = '')
        {
            $this->request = new Request();
            $this->url = $url;
            $this->setPrefix();
        }

        /**
         *  Método responsável por definir os prefixos das rotas
         */
        private function setPrefix()
        {
            //INFORMAÇÕES DA URL ATUAL
            $parseUrl = parse_url($this->url);
            $this->prefix = $parseUrl['path'] ?? '';
        }

        /**
         * Método que adiciona  uma rota na classe
         */
        private function addRoute($method, $route, $params = [])
        {
            //Validação dos params
            foreach ($params as $key => $value) {
                if($value instanceof Closure){
                    $params['controller'] = $value;
                    unset($params[$key]);
                    continue;
                }
            }

            //Variáveis da rota
            $params['variablews'] = [];

            //Padrão de validação das variáveis das rotas
            $patternVariable = '/{(.*?)}/';
            if(preg_match_all($patternVariable, $route, $matches)){
                $route = preg_replace($patternVariable, '(.*?)', $route);
                $params['variables'] = $matches[1];
            }

            //Padrão de validação da url
            $patternRoute = '/^'.str_replace('/', '\/', $route).'$/';
            //Adiciona a rota na classe
            $this->routes[$patternRoute][$method] = $params;
        }

        /**
         * Método que define as rotas do tipo GET
         */
        public function get($route, $params = [])
        {
            return $this->addRoute('GET', $route, $params);
        }

        /**
         * Método que define as rotas do tipo POST
         */
        public function post($route, $params = [])
        {
            return $this->addRoute('POST', $route, $params);
        }

        /**
         * Método que define as rotas do tipo PUT
         */
        public function put($route, $params = [])
        {
            return $this->addRoute('PUT', $route, $params);
        }

        /**
         * Método que define as rotas do tipo DELETE
         */
        public function delete($route, $params = [])
        {
            return $this->addRoute('DELETE', $route, $params);
        }

        /**
        * Retorna a URI sem o prefixo
        */
        private function getUri()
        {
            $uri = $this->request->getUri();
            //Fatia a uri com o prefixo
            $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

            return end($xUri);
        }

        /**
        * Retorna os dados da rota atual
        */
        private function getRoute()
        {
            $uri = $this->getUri();

            $httpMethod = $this->request->getHttpMethod();

            //Validar as Rotas
            foreach ($this->routes as $patternRoute => $methods) {
                //Verifica se a uri bate com o padrão
                if(preg_match($patternRoute, $uri, $matches)) {
                    //Remove a primeira opção
                    unset($matches[0]);

                    //chaves
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    //Verifica o método
                    if(isset($methods[$httpMethod])) {
                        //retorna os parâmetros da rota
                        return $methods[$httpMethod];
                    }
                    throw new Exception("Método não permitido!", 405);
                }
            }

            throw new Exception(View::pageNotFound(), 404);
        }

        /*
         *  Método responsável por executar  a rota atual
         *  @return Response
         */
        public function run()
        {
            try {
                //Obtém a rota atual
                $route = $this->getRoute();

                //Verificar se o controlador existe
                if(!isset($route['controller'])){
                    throw new Exception("Error Processing Request", 500);
                }

                $args = [];

                //Reflection
                $reflection = new ReflectionFunction($route['controller']);
                foreach ($reflection->getParameters() as $parameter) {
                    $name = $parameter->getName();
                    $args[$name] = $route['variables'][$name] ?? '';
                }

                return call_user_func_array($route['controller'], $args);
            } catch (Exception $e) {
                return new Response($e->getCode(), $e->getMessage());
            }
        }
    }
