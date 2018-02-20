<?php

namespace SharktheFire\ToDo\Infrastructure;

use PHPUnit\Framework\TestCase;

use SharktheFire\ToDo\ToDo;
use SharktheFire\ToDo\Types;
use SharktheFire\ToDo\Exceptions\ToDoAlreadyExistsException;
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

        $filename = $this->filePath . 'ToDo: ' . $toDo->id() . ' | ' . $toDo->content() . '.txt';

        $this->assertEquals(true, file_exists($filename));
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionIfToDoAlreadyExists()
    {
        $this->expectException(ToDoAlreadyExistsException::class);
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $this->repository->store($toDo);

        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $this->repository->store($toDo);
    }

    /**
     * @test
     */
    public function itShouldDeleteToDo()
    {
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $this->repository->store($toDo);
        $this->repository->delete($toDo);

        $this->assertFalse(file_exists($this->filePath . 'ToDo: ' . $toDo->id() . ' | ' . $toDo->content() . '.txt'));
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

