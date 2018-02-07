<?php

namespace SharktheFire\ToDo;

use SharktheFire\ToDo\Exceptions\ToDoAlreadyExistsException;

class ToDoFileRepository implements ToDoRepository
{
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function store(ToDo $toDo)
    {
        foreach ($this->findAllToDos() as $storedToDo) {
            if ($toDo->id() === $storedToDo->id()) {
                throw new ToDoAlreadyExistsException('ToDo existiert bereits!');
            }
        }
        file_put_contents($this->filename($toDo), serialize($toDo));
    }

    public function delete(ToDo $toDo)
    {
        unlink($this->filename($toDo));
    }

    public function findToDoById(string $id): ToDo
    {
        $unserializedToDos = $this->findAllToDos();

        foreach ($unserializedToDos as $toDo) {
            if ($id === $toDo->id()) {
                return $toDo;
            }
        }
    }

    private function findAllToDos() {
        $foundToDos = [];

        foreach (scandir($this->filePath) as $foundFile) {
            if (Types::ALLOWED_FILE_TYPE === pathinfo($foundFile, PATHINFO_EXTENSION)) {
                $foundToDos[] = unserialize(file_get_contents($this->filePath . $foundFile));
            }
        }
        return $foundToDos;
    }

    private function filename(ToDo $toDo)
    {
        return $this->filePath . 'ToDo: ' . $toDo->id() . ' | ' . $toDo->content() . '.txt';
    }
}
