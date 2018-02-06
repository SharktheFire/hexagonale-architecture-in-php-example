<?php

namespace SharktheFire\ToDo;

class ToDoFileRepository implements ToDoRepository
{
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function create(string $id, string $content)
    {
        $toDo = new ToDo($id, $content);
        $this->update($toDo);

        return $toDo;
    }

    public function update(ToDo $toDo)
    {
        file_put_contents($this->filename($toDo), serialize($toDo));
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
            if ($foundFile === '.' || $foundFile === '..' || $foundFile === '.DS_Store') {
                continue;
            }
            $foundToDos[] = unserialize(file_get_contents($this->filePath . $foundFile));
        }

        return $foundToDos;
    }

    private function filename(ToDo $toDo)
    {
        return $this->filePath . 'ToDo: ' . $toDo->id() . ' | ' . $toDo->content() . '.txt';
    }
}
