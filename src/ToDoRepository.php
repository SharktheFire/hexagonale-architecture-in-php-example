<?php

namespace SharktheFire\ToDo;

interface ToDoRepository {
    public function addToDo(ToDo $toDo);

    public function findToDoById(string $id);
}
