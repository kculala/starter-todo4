<?php

class Task extends CI_Model {

    private $task;
    private $flag;
    private $group;
    private $priority;
    private $size;
    private $status;

    public function setTask(string $value) {
        if (!ctype_alnum($value) || strlen($value) > 64) {
            throw new Exception('Invalid task description');
        }
        $this->$task = $value;
    }

    public function setFlag(int $value) {
        if ($value != 1) {
            throw new Exception('Invalid flag value');
        }
        $this->$flag = $value;
    }

    public function setGroup(int $value) {
        if ($value < 1 || $value > 4) {
            throw new Exception('Invalid group value');
        }
        $this->$group = $value;
    }

    public function setPriority(int $value) {
        if ($value < 1 || $value > 3) {
            throw new Exception('Invalid priority value');
        }
        $this->$priority = $value;
    }

    public function setSize(int $value) {
        if ($value < 1 || $value > 3) {
            throw new Exception('Invalid size value');
        }
        $this->$size = $value;
    }

    public function setStatus(int $value) {
        if ($value < 1 || $value > 2) {
            throw new Exception('Invalid status value');
        }
        $this->$status = $value;
    }

    // If this class has a setProp method, use it, else modify the property directly
    public function __set($key, $value) {
        // if a set* method exists for this key,
        // use that method to insert this value.
        // For instance, setName(...) will be invoked by $object->name = ...
        // and setLastName(...) for $object->last_name =
        $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
        if (method_exists($this, $method))
        {
                $this->$method($value);
                return $this;
        }

        // Otherwise, just set the property value directly.
        $this->$key = $value;
        return $this;
    }
}
