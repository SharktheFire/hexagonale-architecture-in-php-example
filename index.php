<?php

namespace SharktheFire\ToDo;

require_once 'vendor/autoload.php';

use SharktheFire\ToDo\Infrastructure\ToDoFileRepository;

use SharktheFire\ToDo\Boundary\AddToDoUseCase;
use SharktheFire\ToDo\Boundary\AddToDoRequest;

use SharktheFire\ToDo\Boundary\EditToDoUseCase;
use SharktheFire\ToDo\Boundary\EditToDoRequest;

use SharktheFire\ToDo\Boundary\FinishToDoUseCase;
use SharktheFire\ToDo\Boundary\FinishToDoRequest;

use SharktheFire\ToDo\Boundary\ListToDosUseCase;
use SharktheFire\ToDo\Boundary\ListToDosRequest;

$errorMessage = "Etwas ist schiefgelaufen! Versuche es noch einmal. -> ";

if (!isset($argv[1])) {
    echo 'Bitte einen UseCase eingeben!' . PHP_EOL;
    exit;
}

$arguments = [
    'fileExecuted' => $argv[0],
    'useCase' => $argv[1],
    'id' => !isset($argv[2]) ? '' : $argv[2],
    'content' => !isset($argv[3]) ? '' : $argv[3]
];

switch ($arguments['useCase']) {
    case 'AddToDo':
        $useCase = new AddToDoUseCase(
            new ToDoFileRepository(
                __DIR__ . '/toDos/'
            )
        );

        try {
            $response = $useCase->execute(
                new AddToDoRequest($arguments['id'], $arguments['content'])
            );
            echo 'ToDo mit der ID ' . $response->toDo->id() . ' wurde erstellt!' . PHP_EOL;
        } catch (\Exception $e) {
            echo $errorMessage . $e->getMessage() . PHP_EOL;
        }

        break;
    case 'EditToDo':
        $useCase = new EditToDoUseCase(
            new ToDoFileRepository(
                __DIR__ . '/toDos/'
            )
        );

        try {
            $response = $useCase->execute(
                new EditToDoRequest($argv[2], $argv[3])
            );
            echo $response->showCorrectText() . PHP_EOL;
        } catch (\Exception $e) {
            echo $errorMessage . $e->getMessage() . PHP_EOL;
        }

        break;
    case 'FinishToDo':
        $useCase = new FinishToDoUseCase(
            new ToDoFileRepository(
                __DIR__ . '/toDos/'
            )
        );

        try {
            $response = $useCase->execute(
                new FinishToDoRequest($argv[2])
            );
            echo 'Das ToDo wurde erfolgreich abgehakt! -> ' . $response->showStatus() . PHP_EOL;
        } catch (\Exception $e) {
            echo $errorMessage . $e->getMessage() . PHP_EOL;
        }

        break;
    case 'ListToDos':
        $useCase = new ListToDosUseCase(
            new ToDoFileRepository(
                __DIR__ . '/toDos/'
            )
        );

        try {
            $response = $useCase->execute(
                new ListToDosRequest()
            );

            foreach ($response->getToDos() as $toDo) {
                echo 'ToDo: ' . $toDo->id() . ' mit dem Inhalt ' . $toDo->content() . PHP_EOL;
            }
        } catch (\Exception $e) {
            echo $errorMessage . $e->getMessage() . PHP_EOL;
        }

        break;
    default:
        break;
}




