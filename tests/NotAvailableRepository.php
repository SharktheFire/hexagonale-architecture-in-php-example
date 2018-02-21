<?php

namespace SharktheFire\ToDo;

use SharktheFire\ToDo\Exceptions\RepositoryNotAvailableException;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

use SharktheFire\ToDo\ToDo;

class NotAvailableRepository implements ToDoRepository {
    public function store(ToDo $toDo)
    {
        throw new RepositoryNotAvailableException();
    }

    public function delete(ToDo $toDo)
    {
        throw new RepositoryNotAvailableException();
    }

    public function findToDoById(string $id) : ToDo
    {
        throw new RepositoryNotAvailableException();
    }
}
