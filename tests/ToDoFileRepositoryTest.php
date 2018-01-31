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

    /**
     * @test
     */
    public function itShouldCreateAndSaveToDo()
    {
        $id = '1';
        $content = 'some content';
        $toDo = $this->repository->create($id, $content);

        $this->assertEquals($id, $toDo->id());
        $this->assertEquals($content, $toDo->content());
    }
}

