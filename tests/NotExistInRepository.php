<?php

namespace SharktheFire\ToDo;

use SharktheFire\ToDo\Exceptions\ToDoNotExistsException;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

use SharktheFire\ToDo\ToDo;

class NotExistInRepository implements ToDoRepository
{
    public function store(ToDo $toDo)
    {
        //
    }

    public function delete(ToDo $toDo)
    {
        //
    }

    public function findToDoById(string $id) : ToDo
    {
        throw new ToDoNotExistsException();
    }
}
