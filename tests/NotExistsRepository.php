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

    public function findToDoById(string $id) : ToDo
    {
        throw new ToDoNotExistsException();
    }

    public function findAllToDos(): array
    {
        return [];
    }
}
