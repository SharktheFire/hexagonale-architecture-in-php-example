<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\ToDo;

class FinishToDoResponse
{
    private $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }

    public function getId()
    {
        return $this->toDo->id();
    }

    public function getContent()
    {
        return $this->toDo->content();
    }
}
