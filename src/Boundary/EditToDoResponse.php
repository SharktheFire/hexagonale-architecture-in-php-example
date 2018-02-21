<?php

namespace SharktheFire\ToDo\Boundary;

class EditToDoResponse
{
    public $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }
}
