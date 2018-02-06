<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\ToDoRepository;
use SharktheFire\ToDo\ToDoResponse;

class FindToDoUseCase implements UseCase
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
