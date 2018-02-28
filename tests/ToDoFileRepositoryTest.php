<?php

namespace SharktheFire\ToDo\Infrastructure;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\ToDo;
use SharktheFire\ToDo\Types;
use SharktheFire\ToDo\Exceptions\ToDoNotExistsException;

class ToDoFileRepositoryTest extends TestCase
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
    public function itShouldStoreToDo()
    {
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $this->repository->store($toDo);

        $filename = $this->filePath . 'ToDo: ' . $toDo->id() . '.txt';

        $this->assertEquals(true, file_exists($filename));
    }

    /**
     * @test
     */
    public function itShouldFindToDoById()
    {
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $this->repository->store($toDo);

        $foundToDo = $this->repository->findToDoById($id);

        $this->assertEquals($foundToDo->id(), $id);
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionIfToDoNotFound()
    {
        $this->expectException(ToDoNotExistsException::class);
        $someNotStoredId = '1';
        $foundToDo = $this->repository->findToDoById($someNotStoredId);
    }
}

