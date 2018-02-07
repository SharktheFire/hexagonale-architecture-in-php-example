<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\ToDoRepository;
use SharktheFire\ToDo\ToDoRequest;
use SharktheFire\ToDo\ToDoResponse;

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
