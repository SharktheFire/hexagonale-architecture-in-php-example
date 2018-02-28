<?php

namespace SharktheFire\ToDo\Boundary;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\Boundary\FinishToDoRequest;

use SharktheFire\ToDo\CouldNotStoreRepository;
use SharktheFire\ToDo\NotExistsRepository;

use SharktheFire\ToDo\Exceptions\ToDoCouldNotSaveException;
use SharktheFire\ToDo\Exceptions\ToDoNotExistsException;

class FinishToDoUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldThrowExceptionIfToDoCannotStoreInRepository()
    {
        $this->expectException(ToDoCouldNotSaveException::class);

        $repository = new CouldNotStoreRepository();
        $useCase = new FinishToDoUseCase($repository);

        $response = $useCase->execute(
            new FinishToDoRequest('1', 'some content')
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionIfToDoNotExistsInRepository()
    {
        $this->expectException(ToDoNotExistsException::class);

        $repository = new NotExistsRepository();
        $useCase = new FinishToDoUseCase($repository);

        $response = $useCase->execute(
            new FinishToDoRequest('1', 'some content')
        );
    }
}

