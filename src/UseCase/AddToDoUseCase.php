<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\ToDoRepository;
use SharktheFire\ToDo\Request\ToDoRequest;
use SharktheFire\ToDo\Response\ToDoResponse;

class AddToDoUseCase implements UseCase
{
    private $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ToDoRequest $request): ToDoResponse
    {
        $id = $request->id;
        $content = $request->content;

        $toDo = new ToDo($id, $content);
        $this->repository->store($toDo);

        return new ToDoResponse($toDo);
    }
}
