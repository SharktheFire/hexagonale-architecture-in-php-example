<?php

namespace SharktheFire\ToDo;

use SharktheFire\ToDo\ToDo;

use SharktheFire\ToDo\Exceptions\ToDoNotExistsException;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

class NotExistsRepository implements ToDoRepository
{
    public function store(ToDo $toDo)
    {
        throw new ToDoCouldNotSaveException();
    }

    // public function delete(ToDo $toDo)
    // {
    //     throw new RepositoryNotAvailableException();
    // }

    public function findToDoById(string $id) : ToDo
    {
        throw new ToDoNotExistsException();
    }
}
