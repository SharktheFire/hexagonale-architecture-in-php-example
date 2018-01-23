<?php

namespace Jenny\ToDo\Web;

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
