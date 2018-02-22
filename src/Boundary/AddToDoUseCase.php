<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

use SharktheFire\ToDo\Boundary\AddToDoRequest;
use SharktheFire\ToDo\Boundary\AddToDoResponse;

use SharktheFire\ToDo\ToDo;

use SharktheFire\ToDo\Exceptions\RepositoryNotAvailableException;
use SharktheFire\ToDo\Exceptions\ToDoAlreadyExistsException;

class AddToDoUseCase
{
    private $repository;

    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(AddToDoRequest $request): AddToDoResponse
    {
        $id = $request->getId();
        $content = $request->getContent();

        $toDo = new ToDo($id, $content);

        try {
            $this->repository->store($toDo);
        } catch (Exception $e) {
            throw new RepositoryNotAvailableException('Die Datenbank ist zur Zeit nicht erreichbar!');
        }

        return new AddToDoResponse($toDo);
    }
}
