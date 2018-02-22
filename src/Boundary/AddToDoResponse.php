<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\ToDo;

class AddToDoResponse
{
    public $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }
}
