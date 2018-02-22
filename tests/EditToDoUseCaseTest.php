<?php

namespace SharktheFire\ToDo\Boundary;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\Boundary\EditToDoRequest;

use SharktheFire\ToDo\NotAvailableRepository;
use SharktheFire\ToDo\NotExistInRepository;

use SharktheFire\ToDo\Exceptions\RepositoryNotAvailableException;
use SharktheFire\ToDo\Exceptions\ToDoNotExistsException;

class EditToDoUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldThrowExceptionIfRepositoryNotAvailable()
    {
        $this->expectException(RepositoryNotAvailableException::class);

        $repository = new NotAvailableRepository();
        $useCase = new EditToDoUseCase($repository);

        $response = $useCase->execute(
            new EditToDoRequest('1', 'some content')
        );
    }

    /**
     * @test
     */
    public function itShouldCatchExceptionIfToDoNotExists()
    {
        $this->expectException(ToDoNotExistsException::class);

        $repository = new NotExistInRepository();
        $useCase = new EditToDoUseCase($repository);

        $response = $useCase->execute(
            new EditToDoRequest('1', 'some content')
        );
    }
}

