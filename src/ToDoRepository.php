<?php

namespace SharktheFire\ToDo;

interface ToDoRepository {
    public function create(string $id, string $content);

    public function update(ToDo $toDo);

    public function findToDoById(string $id);
}
