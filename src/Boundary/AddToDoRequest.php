<?php

namespace SharktheFire\ToDo\Boundary;

class AddToDoRequest
{
    private $id;

    private $content;

    public function __construct(string $id, string $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }
}
