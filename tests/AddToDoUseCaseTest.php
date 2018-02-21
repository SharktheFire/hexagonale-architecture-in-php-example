<?php

namespace SharktheFire\ToDo\Boundary;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\Exceptions\RepositoryNotAvailableException;

use SharktheFire\ToDo\Boundary\AddToDoRequest;

use SharktheFire\ToDo\NotAvailableRepository;

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
}

