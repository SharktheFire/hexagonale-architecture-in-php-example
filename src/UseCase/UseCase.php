<?php

namespace SharktheFire\ToDo\UseCase;

use SharktheFire\ToDo\ToDoRequest;
use SharktheFire\ToDo\ToDoResponse;

interface UseCase {
    public function execute(ToDoRequest $request): ToDoResponse;
}
