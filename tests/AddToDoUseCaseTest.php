<?php

namespace SharktheFire\ToDo\Boundary;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\Boundary\AddToDoRequest;

use SharktheFire\ToDo\CouldNotStoreRepository;

use SharktheFire\ToDo\Exceptions\ToDoCouldNotSaveException;

class AddToDoUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldThrowExceptionIfToDoCannotStoreInRepository()
    {
        $this->expectException(ToDoCouldNotSaveException::class);

        $repository = new CouldNotStoreRepository();
        $useCase = new AddToDoUseCase($repository);

        $response = $useCase->execute(
            new AddToDoRequest('1', 'some content')
        );
    }
}

