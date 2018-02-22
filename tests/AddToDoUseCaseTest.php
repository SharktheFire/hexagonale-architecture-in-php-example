<?php

namespace SharktheFire\ToDo\Boundary;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\Boundary\AddToDoRequest;

use SharktheFire\ToDo\NotAvailableRepository;
use SharktheFire\ToDo\NotWriteableRepository;
use SharktheFire\ToDo\Infrastructure\ToDoFileRepository;

use SharktheFire\ToDo\Exceptions\RepositoryNotAvailableException;
use SharktheFire\ToDo\Exceptions\ToDoAlreadyExistsException;

class AddToDoUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldThrowExceptionIfRepositoryNotAvailable()
    {
        $this->expectException(RepositoryNotAvailableException::class);

        $repository = new NotAvailableRepository();
        $useCase = new AddToDoUseCase($repository);

        $response = $useCase->execute(
            new AddToDoRequest('1', 'some content')
        );
    }

// Muss der Test wirklich in der AddToDoUseCase sein oder eigentlich im Repository

    /**
     * @test
     */
    public function itShouldCatchExceptionIfToDoAlreadyExistsWithId()
    {
        $this->expectException(ToDoAlreadyExistsException::class);

        $repository = new NotWriteableRepository();
        $useCase = new AddToDoUseCase($repository);

        $response = $useCase->execute(
            new AddToDoRequest('1', 'some content')
        );
    }
}

