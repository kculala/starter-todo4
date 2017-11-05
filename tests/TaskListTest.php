<?php

use PHPUnit\Framework\TestCase;

if (!class_exists('\PHPUnit\Framework\TestCase') &&
    class_exists('\PHPUnit_Framework_TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', 'PHPUnit\Framework\TestCase');
}

class TaskListTest extends TestCase {
    private $CI;

    public function setUp() {
        // Load CI instance normally
        $this->CI = &get_instance();
    }

    public function testUncompletedTasksGreaterThanCompleted() {
        $numOfUncompleted = 0;
        $tasks = (new Tasks()) -> all();

        foreach ($tasks as $task) {
            if ($task->status != 2) {
                $numOfUncompleted++;
            }
        }

        $this->assertGreaterThan(count($tasks)/2, $numOfUncompleted);
    }
}
