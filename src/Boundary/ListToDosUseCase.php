<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

use SharktheFire\ToDo\Boundary\ListToDosRequest;
use SharktheFire\ToDo\Boundary\ListToDosResponse;

class ListToDosUseCase
{
    private $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ListToDosRequest $request): ListToDosResponse
    {
        return new ListToDosResponse($this->repository->findAllToDos());
    }
}
