<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\ToDo;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

use SharktheFire\ToDo\Boundary\FinishToDoRequest;
use SharktheFire\ToDo\Boundary\FinishToDoResponse;

use SharktheFire\ToDo\Exceptions\ToDoCouldNotSaveException;

class FinishToDoUseCase
{
    private $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(FinishToDoRequest $request): FinishToDoResponse
    {
        $id = $request->getId();
        $toDo = $this->repository->findToDoById($id);

        if (!$toDo->isFinished()) {
            $toDo->toggleFinish();
        }

        try {
            $this->repository->store($toDo);
        } catch (ToDoCouldNotSaveException $e) {
            throw new ToDoCouldNotSaveException($e);
        }

        return new FinishToDoResponse($toDo);
    }
}
