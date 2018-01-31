<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\ToDoRepository;

class AddToDoUseCase {

    private $repository;

    public function __construct(ToDoRepository $repository) {
        $this->repository = $repository;
    }

    public function execute(ToDoRequest $request) {
        // sachen machen
    }
}
