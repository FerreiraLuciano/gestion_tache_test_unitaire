<?php

use App\Entity\TaskManager;
use PHPUnit\Framework\TestCase;

class TaskManagerTest extends TestCase
{

    function testConstructor(): void
    {
        $taskManager = new TaskManager();

        $this->assertEquals([], $taskManager->getTasks());
    }

    function testAddTask(): void
    {
        $taskManager = new TaskManager();

        $taskManager->addTask("tache");
        $this->assertEquals(["tache"], $taskManager->getTasks());
    }

    function testGetTask(): void
    {
        $taskManager = new TaskManager();

        $taskManager->addTask("tache");
        $this->assertEquals("tache", $taskManager->getTask(0));
    }

    function testRemoveTask(): void
    {
        $taskManager = new TaskManager();

        $taskManager->addTask("tache");
        $taskManager->removeTask(0);
        $this->assertEquals([], $taskManager->getTasks());
    }

    function testRemoveInvalidIndexThrowsException(): void
    {
        $taskManager = new TaskManager();

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 0");
        $taskManager->removeTask(0);
    }

    function testGetInvalidIndexThrowsException(): void
    {
        $taskManager = new TaskManager();

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 0");
        $taskManager->getTask(0);
    }

    function testTaskOrderAfterRemoval(): void
    {
        $taskManager = new TaskManager();

        for ($i = 0; $i < 5; $i++) {
            $taskManager->addTask("tache " . $i);
        }

        $taskManager->removeTask(3);
        $this->assertEquals(["tache 0", "tache 1", "tache 2", "tache 4"], $taskManager->getTasks());
    }
}