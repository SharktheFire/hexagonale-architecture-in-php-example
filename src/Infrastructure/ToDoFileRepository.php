<?php

namespace SharktheFire\ToDo\Infrastructure;

use SharktheFire\ToDo\Exceptions\ToDoAlreadyExistsException;
use SharktheFire\ToDo\Exceptions\ToDoNotExistsException;

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
        $foundToDos = $this->findAllToDos();

        foreach ($foundToDos as $storedToDo) {

            // AddToDo kann auch ein existierenden ToDo momentan verändern - alles andere funktioniert
            if ($toDo->id() === $storedToDo->id() && $toDo->content() !== $storedToDo->content()) {
                $this->delete($storedToDo);
                file_put_contents($this->filename($toDo), serialize($toDo));
                continue;
            }

            if ($toDo->id() === $storedToDo->id() || $toDo->content() === $storedToDo->content()) {
                throw new ToDoAlreadyExistsException('Dieses ToDo existiert bereits!');
            }

            if ($toDo->id() !== $storedToDo->id() && $toDo->content() !== $storedToDo->content()) {
                file_put_contents($this->filename($toDo), serialize($toDo));
            }
        }

        if ($foundToDos === []) {
            file_put_contents($this->filename($toDo), serialize($toDo));
        }
    }

    public function delete(ToDo $toDo)
    {
        unlink($this->filename($toDo));
    }

    public function findToDoById(string $id): ToDo
    {
        $unserializedToDos = $this->findAllToDos();

        $foundToDo = [];
        foreach ($unserializedToDos as $toDo) {
            if ($id === $toDo->id()) {
                $foundToDo = $toDo;
            }
        }

        if ($foundToDo === []) {
            throw new ToDoNotExistsException('ToDo existiert nicht!');
        }

        return $foundToDo;
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
