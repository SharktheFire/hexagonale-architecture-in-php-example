<?php

namespace SharktheFire\ToDo\Infrastructure;

use SharktheFire\ToDo\ToDo;

interface ToDoRepository {
    public function store(ToDo $toDo);

    public function delete(ToDo $toDo);

    public function findToDoById(string $id): ToDo;
}
