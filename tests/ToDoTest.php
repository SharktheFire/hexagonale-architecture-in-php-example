<?php

namespace SharktheFire\ToDo;

use PHPUnit\Framework\TestCase;

class ToDoTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldHaveStatusNotFinishedIfToDoCreated()
    {
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $this->assertEquals(false, $toDo->isFinished());
    }

    /**
     * @test
     */
    public function itShouldHaveStatusIsFinishedIfToDoFinished()
    {
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $toDo->toggleFinish();

        $this->assertEquals(true, $toDo->isFinished());
    }

    /**
     * @test
     */
    public function itShouldEditContent()
    {
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $newContent = 'some other content';
        $toDo->editContent($newContent);

        $this->assertEquals($newContent, $toDo->content());
    }
}
