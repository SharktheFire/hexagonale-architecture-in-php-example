<?php

namespace SharktheFire\ToDo;

use SharktheFire\ToDo\ToDo;

use SharktheFire\ToDo\Exceptions\ToDoCouldNotSaveException;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

class CouldNotStoreRepository implements ToDoRepository {
    public function store(ToDo $toDo)
    {
        throw new ToDoCouldNotSaveException();
    }

    public function findToDoById(string $id) : ToDo
    {
        return new ToDo('1', 'some content');
    }
}
