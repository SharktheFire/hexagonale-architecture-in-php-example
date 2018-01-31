<?php

namespace SharktheFire\ToDo;

class ToDoResponse
{
    public $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }
}
