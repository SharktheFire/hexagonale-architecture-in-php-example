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

    public function showStatus()
    {
        return $this->toDo->isFinished() ? 'true' : 'false';
    }
}
