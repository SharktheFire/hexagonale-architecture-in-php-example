<?php

namespace SharktheFire\ToDo\Request;

class ToDoRequest {

    public $id;

    public $content;

    public function __construct(string $id, string $content){
        $this->id = $id;
        $this->content = $content;
    }
}
