<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\ToDo;

class EditToDoResponse
{
    private $toDo;

    private $editContentIsPossible;

    public function __construct(ToDo $toDo, bool $editContentIsPossible)
    {
        $this->toDo = $toDo;
        $this->editContentIsPossible = $editContentIsPossible;
    }

    public function getId()
    {
        return $this->toDo->id();
    }

    public function getContent()
    {
        return $this->toDo->content();
    }

    public function getStatus()
    {
        return $this->toDo->isFinished();
    }

    public function showCorrectText()
    {
        if ($this->editContentIsPossible) {
            return "Das ToDo mit der ID " . $this->getId() . " wurde erfolgreich bearbeitet! -> " . $this->getContent();
        }
        return "Das ToDo mit der ID " . $this->getId() . " konnte nicht mehr bearbeitet werden! Finish Status ist -> " . ($this->getStatus() ? 'true' : 'false') . PHP_EOL;
    }
}
