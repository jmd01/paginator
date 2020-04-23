<?php

namespace Johnd\Paginator\Tests\Utils;

class MyIterator implements \Iterator {
    private $position = 0;
    protected $data = [];

    public function __construct(array $data) {
        $this->position = 0;
        $this->data = $data;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->data[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->data[$this->position]);
    }

}
