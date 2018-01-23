<?php

namespace Jenny\ToDo\Web;

use Jenny\ToDo\ToDoController as ToDoController;

class Router
{
    /** @var Request */
    private $request;

    /** @var Response */
    private $response;

    /**
     * @param array $config
     */
    public function __construct()
    {
        $this->request = new Request($_GET, $_POST, $_SESSION);
        $this->response = new Response();
    }

    /**
     * @param string $uri
     * @return mixed
     */
    public function dispatch(string $uri)
    {
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }

        $uriParts = explode('/', trim($uri, '/'));

        if (count($uriParts) >= 1) {

            //Ignore favicon
            if ($uriParts[0] === 'favicon.ico') {
                return;
            }

            if ($uriParts[0] !== '') {

                $controller = new ToDoController($this->request, $this->response);

                if (count($uriParts) >= 2) {
                    if ($uriParts[1] !== '') {
                        $action = $uriParts[1];
                    }
                }
            }
        }

        $action = $action . 'Action';

        return $controller->$action();
    }
}
