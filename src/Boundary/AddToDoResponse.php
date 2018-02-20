<?php

namespace SharktheFire\ToDo\Boundary;

class AddToDoResponse
{
    public $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }
}
