<?php

namespace SharktheFire\ToDo;

class ToDoFileRepository implements ToDoRepository
{
    const ALLOWED_FILE_TYPE = 'txt';

    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function store(ToDo $toDo)
    {
        file_put_contents($this->filename($toDo), serialize($toDo));
    }

    public function delete(ToDo $toDo)
    {

    }

    public function findToDoById(string $id)
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
            if (self::ALLOWED_FILE_TYPE === pathinfo($foundFile, PATHINFO_EXTENSION)) {
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
