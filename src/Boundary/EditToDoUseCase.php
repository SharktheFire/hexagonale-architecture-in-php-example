<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\Repository\ToDoRepository;
use SharktheFire\ToDo\Request\ToDoRequest;
use SharktheFire\ToDo\Response\ToDoResponse;

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

        $this->repository->store($toDo);
        var_dump($toDo);

        return new ToDoResponse($toDo);
    }
}
