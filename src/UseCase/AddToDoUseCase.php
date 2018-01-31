<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\ToDoRepository;

class AddToDoUseCase {

    private $repository;

    public function __construct(ToDoRepository $repository) {
        $this->repository = $repository;
    }

    public function execute(ToDoRequest $request) {
        $id = $request->id;
        $content = $request->content;

        $toDo = new ToDo($id, $content);

        $this->repository->addToDo($toDo);
    }
}
