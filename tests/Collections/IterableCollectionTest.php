<?php

namespace Johnd\Paginator\Tests\Collections;

use PHPUnit\Framework\TestCase;
use Johnd\Paginator\Collections\IterableCollection;
use Johnd\Paginator\Tests\Utils\MyIteratorAggregate;
use Johnd\Paginator\Tests\Utils\MyIterator;

class IterableCollectionTest extends TestCase
{

    protected $input;

    public function setUp() : void 
    {
        $this->input = ['alpha', 'beta', 'delta', 'gamma'];
    }
    
    public function testGetTotalWithArray()
    {
        $collection = new IterableCollection($this->input);

        $result = $collection->getTotal();
        $this->assertEquals(4, $result);
    }

    public function testGetSubsetWithArray()
    {
        $collection = new IterableCollection($this->input);

        $result = $collection->getSubset(1,2);
        $this->assertEquals(['delta'], $result);
    }

    public function testGetTotalWithArrayObject()
    {
        $iterator = new \ArrayObject($this->input);
        $collection = new IterableCollection($iterator);

        $result = $collection->getTotal();
        $this->assertEquals(4, $result);
    }

    public function testGetSubsetWithArrayObject()
    {
        $iterator = new \ArrayObject($this->input);
        $collection = new IterableCollection($iterator);

        $result = $collection->getSubset(1,2);
        $this->assertEquals(['delta'], $result);
    }

    public function testGetTotalWithArrayIterator()
    {
        $iterator = new \ArrayIterator($this->input);
        $collection = new IterableCollection($iterator);

        $result = $collection->getTotal();
        $this->assertEquals(4, $result);
    }

    public function testGetSubsetWithArrayIterator()
    {
        $iterator = new \ArrayIterator($this->input);
        $collection = new IterableCollection($iterator);

        $result = $collection->getSubset(1,2);
        $this->assertEquals(['delta'], $result);
    }

    public function testGetTotalWithIteratorAggregate()
    {
        $iterator = new MyIteratorAggregate($this->input);
        $collection = new IterableCollection($iterator);

        $result = $collection->getTotal();
        $this->assertEquals(4, $result);
    }

    public function testGetSubsetWithIteratorAggregate()
    {
        $iterator = new MyIteratorAggregate($this->input);
        $collection = new IterableCollection($iterator);

        $result = $collection->getSubset(1,2);
        $this->assertEquals(['delta'], $result);
    }


    public function testGetTotalWithIterator()
    {
        $iterator = new MyIterator($this->input);
        $collection = new IterableCollection($iterator);

        $result = $collection->getTotal();
        $this->assertEquals(4, $result);
    }

    public function testGetSubsetWithIterator()
    {
        $iterator = new MyIterator($this->input);
        $collection = new IterableCollection($iterator);

        $result = $collection->getSubset(1,2);
        $this->assertEquals(['delta'], $result);
    }

    protected function tearDown(): void
    {
        unset($this->input);
    }

}