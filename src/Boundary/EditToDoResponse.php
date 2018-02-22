<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\ToDo;

class EditToDoResponse
{
    public $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }
}
