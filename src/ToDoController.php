<?php

namespace Jenny\ToDo;

use Jenny\ToDo\Web\Request as Request;
use Jenny\ToDo\Web\Response as Response;

class ToDoController extends Web\Controller {

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(
        Request $request,
        Response $response
    ) {
        parent::__construct($request, $response);
    }

    public function listAction() {
        $view = $this->view('Web/ToDoView.php');
        echo $view->render();
    }
}
