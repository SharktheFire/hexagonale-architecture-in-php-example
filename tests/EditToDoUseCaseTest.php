<?php

namespace SharktheFire\ToDo\Boundary;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\Boundary\EditToDoRequest;

use SharktheFire\ToDo\CouldNotStoreRepository;
use SharktheFire\ToDo\NotExistsRepository;

use SharktheFire\ToDo\Exceptions\ToDoCouldNotSaveException;
use SharktheFire\ToDo\Exceptions\ToDoNotExistsException;

class EditToDoUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldThrowExceptionIfToDoCannotStoreInRepository()
    {
        $this->expectException(ToDoCouldNotSaveException::class);

        $repository = new CouldNotStoreRepository();
        $useCase = new EditToDoUseCase($repository);

        $response = $useCase->execute(
            new EditToDoRequest('1', 'some content')
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionIfToDoNotExistsInRepository()
    {
        $this->expectException(ToDoNotExistsException::class);

        $repository = new NotExistsRepository();
        $useCase = new EditToDoUseCase($repository);

        $response = $useCase->execute(
            new EditToDoRequest('1', 'some content')
        );
    }
}

