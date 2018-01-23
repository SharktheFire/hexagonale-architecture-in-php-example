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

    public function createToDoAction()
    {
        $view = $this->view('Views/CreateToDoView.php');
        $view->action = '/todo/create';
        $this->render($view);
    }

    public function createAction()
    {
        var_dump($this->formData('content'));

        // $this->redirect("/report/list");
    }
}
