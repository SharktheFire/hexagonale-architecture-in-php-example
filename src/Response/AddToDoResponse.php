<?php

namespace SharktheFire\ToDo\Response;

class AddToDoResponse
{
    public $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }
}
