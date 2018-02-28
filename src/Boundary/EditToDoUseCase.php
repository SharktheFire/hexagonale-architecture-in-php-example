<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

use SharktheFire\ToDo\Boundary\EditToDoRequest;
use SharktheFire\ToDo\Boundary\EditToDoResponse;

use SharktheFire\ToDo\Exceptions\ToDoCouldNotSaveException;

class EditToDoUseCase
{
    private $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(EditToDoRequest $request): EditToDoResponse
    {
        $id = $request->getId();
        $newContent = $request->getContent();

        $toDo = $this->repository->findToDoById($id);
        $toDo->editContent($newContent);

        try {
            $this->repository->store($toDo);
        } catch (ToDoCouldNotSaveException $e) {
            throw new ToDoCouldNotSaveException($e);
        }

        return new EditToDoResponse($toDo);
    }
}
