<?php

namespace SharktheFire\ToDo;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

use SharktheFire\ToDo\ToDo;

use SharktheFire\ToDo\Exceptions\ToDoAlreadyExistsException;

class NotWriteableRepository implements ToDoRepository
{
    public function store(ToDo $toDo)
    {
        if ($toDo->id() === '1') {
            throw new ToDoAlreadyExistsException();
        }
    }

    public function delete(ToDo $toDo)
    {
        //
    }

    public function findToDoById(string $id) : ToDo
    {
        //
    }
}
