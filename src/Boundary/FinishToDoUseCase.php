<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;
use SharktheFire\ToDo\Boundary\ToDoRequest;
use SharktheFire\ToDo\Boundary\ToDoResponse;

class FinishToDoUseCase
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
