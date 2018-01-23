<?php

namespace Jenny\ToDo\Web;

use Jenny\ToDo\Web\Request as Request;
use Jenny\ToDo\Web\Response as Response;
use Jenny\ToDo\Web\View as View;

abstract class Controller
{
    /** @var Request */
    protected $request;

    /** @var Response */
    protected $response;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(
        Request $request,
        Response $response
    ) {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    protected function queryParams(string $key = null, string $default = null)
    {
        return $this->request->getQueryParams($key, $default);
    }

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    protected function formData(string $key = null, string $default = null)
    {
        return $this->request->getFormData($key, $default);
    }

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    protected function sessionData(string $key = null, string $default = null)
    {
        return $this->request->getSessionData($key, $default);
    }

    /**
     * @param string $path
     * @param array $queryParams
     */
    protected function redirect(string $path, array $queryParams = null)
    {
        $queryString = '';
        if ($queryParams !== null) {
            $queryString = '?' . http_build_query($queryParams);
        }
        $uri = $path . $queryString;
        header("Location: $uri");
    }

    /**
     * @return View
     */
    protected function view() : View
    {
        return new View();
    }

    /**
     * @param View $view
     */
    protected function render(View $view)
    {
        return $this->response->render($view);
    }
}
