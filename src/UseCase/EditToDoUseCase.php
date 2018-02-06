<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\ToDoRepository;
use SharktheFire\ToDo\ToDoResponse;
use SharktheFire\ToDo\ToDoRequest;

class EditToDoUseCase implements UseCase
{
    private $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ToDoRequest $request) : ToDoResponse
    {
        $id = $request->id;
        $newContent = $request->content;
        var_dump($newContent);

        $toDo = $this->repository->findToDoById($id);
        var_dump($toDo);

        $toDo->editContent($newContent);
        var_dump($toDo);

        $this->repository->update($toDo);
        var_dump($toDo);

        return new ToDoResponse($toDo);
    }
}
