<?php

namespace SharktheFire\ToDo\Boundary;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\ToDo;
use SharktheFire\ToDo\Types;

use SharktheFire\ToDo\Boundary\ListToDosRequest;

use SharktheFire\ToDo\Boundary\AddToDoUseCase;
use SharktheFire\ToDo\Boundary\AddToDoUseRequest;

use SharktheFire\ToDo\Infrastructure\ToDoFileRepository;

class ListToDosUseCaseTest extends TestCase
{
    private $repository;

    private $filePath = __DIR__ . '/../toDos/';

    public function setUp()
    {
        $this->repository = new ToDoFileRepository($this->filePath);
    }

    public function tearDown()
    {
        foreach (scandir($this->filePath) as $foundFile) {
            if (Types::ALLOWED_FILE_TYPE === pathinfo($foundFile, PATHINFO_EXTENSION)) {
                unlink($this->filePath . $foundFile);
            }
        }
    }

    /**
     * @test
     */
    public function itShouldReturnListOfAllExistingToDos()
    {
        $useCase = new AddToDoUseCase($this->repository);
        $useCase->execute(
            new AddToDoRequest('1', 'some content')
        );
        $useCase->execute(
            new AddToDoRequest('2', 'some other content')
        );


        $useCase = new ListToDosUseCase($this->repository);

        $response = $useCase->execute(
            new ListToDosRequest()
        );

        $this->assertEquals([
                0 => new ToDo('1', 'some content'),
                1 => new ToDo('2', 'some other content')
            ], $response->getToDos()
        );
    }
}

