<?php

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase {

    private $CI;

    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
      $this->task = new Task();
    }

    public function testTaskValidTaskValue() {
        $task->task = 'unit test';
        $this->assertEquals($task->task, 'unit test');
    }

    public function testTaskInvalidTaskValueTooLong() {
        $this->expectException(Exception::class);
        $task->task = 'VlbKuOPhhBSrNzCFPQOPiNouITNKXmxENMQFVuwCXcQcPNRIZocffrMWgAZrtqhEzjfIWP';
    }

    public function testTaskInvalidTaskValueSpecialChars() {
        $this->expectException(Exception::class);
        $task->task = 'foo!#$bar';
    }

    public function testTaskValidFlagValue() {
        $task->flag = '1';
        $this->assertEquals($task->flag, '1');
    }

    public function testTaskInvalidFlagValue() {
        $this->expectException(Exception::class);
        $task->flag = 0;
    }

    public function testTaskInvalidFlagType() {
        $this->expectException(Exception::class);
        $task->flag = 'a';
    }

    public function testTaskValidGroupValue() {
        $task->group = 2;
        $this->assertEquals($task->group, 2);
    }

    public function testTaskInvalidGroupValue() {
        $this->expectException(Exception::class);
        $task->group = -1;
    }

    public function testTaskInvalidGroupType() {
        $this->expectException(Exception::class);
        $task->group = 'a';
    }

    public function testTaskValidPriorityValue() {
        $task->group = 3;
        $this->assertEquals($task->group, 3);
    }

    public function testTaskInvalidPriorityValue() {
        $this->expectException(Exception::class);
        $task->group = 4;
    }

    public function testTaskInvalidPriorityType() {
        $this->expectException(Exception::class);
        $task->group = 'a';
    }

    public function testTaskValidSizeValue() {
        $task->size = 2;
        $this->assertEquals($task->size, 2);
    }

    public function testTaskInvalidSizeValue() {
        $this->expectException(Exception::class);
        $task->size = -4;
    }

    public function testTaskInvalidSizeType() {
        $this->expectException(Exception::class);
        $task->size = 'a';
    }

    public function testTaskValidStatusValue() {
        $task->size = 1;
        $this->assertEquals($task->size, 1);
    }

    public function testTaskInvalidStatusValue() {
        $this->expectException(Exception::class);
        $task->size = -2;
    }

    public function testTaskInvalidStatusType() {
        $this->expectException(Exception::class);
        $task->size = 'a';
    }
}
