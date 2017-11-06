<?php

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase {

    private $CI;
    private $task;
    
    public function setUp() {
      // Load CI instance normally
      $this->CI = &get_instance();
      $this->task = new Task();
    }

    public function testTaskValidTaskValue() {
        $this->task->task = 'unit test';
        $this->assertEquals($this->task->task, 'unit test');
    }

    public function testTaskInvalidTaskValueTooLong() {
        $this->expectException(Exception::class);
        $this->task->task = 'VlbKuOPhhBSrNzCFPQOPiNouITNKXmxENMQFVuwCXcQcPNRIZocffrMWgAZrtqhEzjfIWP';
    }

    public function testTaskInvalidTaskValueSpecialChars() {
        $this->expectException(Exception::class);
        $this->task->task = 'foo!#$bar';
    }

    public function testTaskValidFlagValue() {
        $this->task->flag = '1';
        $this->assertEquals($this->task->flag, '1');
    }

    public function testTaskInvalidFlagValue() {
        $this->expectException(Exception::class);
        $this->task->flag = 0;
    }

    public function testTaskInvalidFlagType() {
        $this->expectException(TypeError::class);
        $this->task->flag = 'a';
    }

    public function testTaskValidGroupValue() {
        $this->task->group = 2;
        $this->assertEquals($this->task->group, 2);
    }

    public function testTaskInvalidGroupValue() {
        $this->expectException(Exception::class);
        $this->task->group = -1;
    }

    public function testTaskInvalidGroupType() {
        $this->expectException(TypeError::class);
        $this->task->group = 'a';
    }

    public function testTaskValidPriorityValue() {
        $this->task->priority = 3;
        $this->assertEquals($this->task->priority, 3);
    }

    public function testTaskInvalidPriorityValue() {
        $this->expectException(Exception::class);
        $this->task->priority = 4;
    }

    public function testTaskInvalidPriorityType() {
        $this->expectException(TypeError::class);
        $this->task->priority = 'a';
    }

    public function testTaskValidSizeValue() {
        $this->task->size = 2;
        $this->assertEquals($this->task->size, 2);
    }

    public function testTaskInvalidSizeValue() {
        $this->expectException(Exception::class);
        $this->task->size = -4;
    }

    public function testTaskInvalidSizeType() {
        $this->expectException(TypeError::class);
        $this->task->size = 'a';
    }

    public function testTaskValidStatusValue() {
        $this->task->status = 1;
        $this->assertEquals($this->task->status, 1);
    }

    public function testTaskInvalidStatusValue() {
        $this->expectException(Exception::class);
        $this->task->status = -2;
    }

    public function testTaskInvalidStatusType() {
        $this->expectException(TypeError::class);
        $this->task->status = 'a';
    }
}
