<?php

namespace SharktheFire\ToDo;

class ToDoRequest {

    public $id;

    public $content;

    public function __construct(stirng $id, string $content) {
        $this->id = $id;
        $this->content = $content;
    }
}
