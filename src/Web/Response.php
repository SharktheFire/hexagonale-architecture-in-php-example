<?php

namespace Jenny\ToDo\Web;

use Jenny\ToDo\Web\View as View;

class Response
{
    /**
     * @return string
     */
    public function render(View $view)
    {
        echo $view->render();
    }
}
