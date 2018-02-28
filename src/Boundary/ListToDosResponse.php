<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\ToDo;

class ListToDosResponse
{
    private $toDos;

    public function __construct(array $toDos)
    {
        $this->toDos = $toDos;
    }

    public function getToDos()
    {
        return $this->toDos;
    }
}
