<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\ToDoRepository;
use SharktheFire\ToDo\Request\ToDoRequest;
use SharktheFire\ToDo\Response\ToDoResponse;

class FininishToDoUseCase implements UseCase
{
    private $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ToDoRequest $request) : ToDoResponse
    {
        $id = $request->id;

        $toDo = $this->repository->findToDoById($id);

        return new ToDoResponse($toDo);
    }
}
