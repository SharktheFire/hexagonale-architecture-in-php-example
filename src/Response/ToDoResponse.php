<?php

namespace SharktheFire\ToDo\Response;

class ToDoResponse
{
    public $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }
}
