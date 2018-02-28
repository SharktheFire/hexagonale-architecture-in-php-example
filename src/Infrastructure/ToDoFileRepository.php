<?php

namespace SharktheFire\ToDo\Infrastructure;

use SharktheFire\ToDo\Exceptions\ToDoNotExistsException;
use SharktheFire\ToDo\Exceptions\ToDoCouldNotSaveException;

use SharktheFire\ToDo\ToDo;
use SharktheFire\ToDo\Types;

class ToDoFileRepository implements ToDoRepository
{
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function store(ToDo $toDo)
    {
        try {
            file_put_contents($this->filename($toDo), serialize($toDo));
        } catch (ToDoCouldNotSaveException $e) {
            throw new ToDoCouldNotSaveException("Das ToDo konnte nicht gespeichert werden!");
        }
    }

    public function findToDoById(string $id): ToDo
    {
        $unserializedToDos = $this->findAllToDos();

        foreach ($unserializedToDos as $toDo) {
            if ($id === $toDo->id()) {
                return $toDo;
            }
        }

        throw new ToDoNotExistsException('ToDo existiert nicht!');
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
        return $this->filePath . 'ToDo: ' . $toDo->id() . '.txt';
    }
}
