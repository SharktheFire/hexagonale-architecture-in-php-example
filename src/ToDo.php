<?php

namespace SharktheFire\ToDo;

class ToDo {
    private $id;

    private $content;

    public function __construct(string $id, string $content) {
        $this->id = $id;
        $this->content = $content;
    }

    public function id() {
        return $this->id;
    }

    public function content() {
        return $this->content;
    }

    public function editContent(string $content) {
        $this->content = $content;
    }
}
