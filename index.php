<?php

namespace SharktheFire\ToDo;

require_once 'vendor/autoload.php';

use SharktheFire\ToDo\UseCase\AddToDoUseCase;
use SharktheFire\ToDo\UseCase\EditToDoUseCase;

$useCase = new AddToDoUseCase(
    new ToDoFileRepository(
        __DIR__ . '/toDos/'
        )
    );

$response = $useCase->execute(
    new ToDoRequest($argv[1], $argv[2])
);

echo 'ToDo mit der ID ' . $response->toDo->id() . ' wurde ersellt!' . PHP_EOL;


// $useCase = new EditToDoUseCase(
//     new ToDoFileRepository(
//         __DIR__ . '/toDos/'
//         )
//     );

// $response = $useCase->execute(
//     new ToDoRequest($argv[1], $argv[2])
// );

// echo 'Das ToDo mit der ID ' . $response->toDo->id() . ' wurde erfolgreich bearbeitet!' . PHP_EOL;

$service = new Service();


$useCase = new AddToDoUseCase(
    $service['FileRepository']
)




