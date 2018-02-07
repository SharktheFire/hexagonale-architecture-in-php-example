<?php

namespace SharktheFire\ToDo;

use PHPUnit\Framework\TestCase;

class ToDoFileRepositoryTest extends TestCase
{
    private $repository;

    public function setUp()
    {
        $this->repository = new ToDoFileRepository(__DIR__ . '/../toDos/');
    }

    public function tearDown()
    {
        $this->deleteFiles();
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

        $filename = __DIR__ . '/../toDos/' . 'ToDo: ' . $toDo->id() . ' | ' . $toDo->content() . '.txt';

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

    private function deleteFiles() {
        foreach (scandir(__DIR__ . '/../toDos/') as $foundFile) {
            if (Types::ALLOWED_FILE_TYPE === pathinfo($foundFile, PATHINFO_EXTENSION)) {
                unlink(__DIR__ . '/../toDos/' . $foundFile);
            }
        }
    }
}

