<?php

namespace SharktheFire\ToDo;

use PHPUnit\Framework\TestCase;

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
     * @expectedException SharktheFire\ToDo\Exceptions\ToDoAlreadyExistsException
     */
    public function itShouldThrowExceptionIfToDoAlreadyExists()
    {
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
}

