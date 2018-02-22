<?php

namespace SharktheFire\ToDo\Boundary;

use SharktheFire\ToDo\Infrastructure\ToDoRepository;

use SharktheFire\ToDo\Boundary\EditToDoRequest;
use SharktheFire\ToDo\Boundary\EditToDoResponse;

use SharktheFire\ToDo\ToDo;

use SharktheFire\ToDo\Exceptions\RepositoryNotAvailableException;

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

        // Tests und Exceptions mit Hauke durchgehen
        // Add und Edit das gleiche?? - Speichern in die Datenbank - Edit nur noch suchen

        try {
            $toDo = $this->repository->findToDoById($id);
        } catch (ToDoNotExistsException $e) {
            // handle error
        } catch (Exception $e) {
            throw new RepositoryNotAvailableException('Die Datenbank ist zur Zeit nicht erreichbar!');
        }

        $toDo->editContent($newContent);

        try {
            $this->repository->store($toDo);
        } catch (Exception $e) {
            throw new RepositoryNotAvailableException('Die Datenbank ist zur Zeit nicht erreichbar!');
        }

        return new EditToDoResponse($toDo);
    }
}
