<?php

namespace SharktheFire\ToDo;

use PHPUnit\Framework\TestCase;

class ToDoTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldHaveId()
    {
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $this->assertEquals($id, $toDo->id());

        $id = '2';
        $content = 'some other content';
        $toDo = new ToDo($id, $content);

        $this->assertEquals($id, $toDo->id());
    }

    /**
     * @test
     */
    public function itShouldHaveContent()
    {
        $id = '1';
        $content = 'some content';
        $toDo = new ToDo($id, $content);

        $this->assertEquals($content, $toDo->content());

        $id = '2';
        $content = 'some other content';
        $toDo = new ToDo($id, $content);

        $this->assertEquals($content, $toDo->content());
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
