<?php


namespace Johnd\Paginator\Collections;

use Johnd\Paginator\Contracts\CollectionInterface;

/**
 * Class IterableCollection
 * @package Johnd\Paginator
 * @implements CollectionInterface
 */
class IterableCollection implements CollectionInterface
{
    /**
     * @var iterable
     */
    protected $collection;

    /**
     * @var int
     */
    protected $total;

    /**
     * IterableCollection constructor.
     * @param iterable $collection
     */
    public function __construct(iterable $collection)
    {
        $this->collection = is_array($collection) ? new \ArrayObject($collection) : $collection;
        $this->total = iterator_count($this->collection);
    }

    /**
     * @return int
     */
    public function getTotal() : int
    {
        return $this->total;
    }

    /**
     * @param int $length
     * @param int $offset
     * @return array
     */
    public function getSubset(int $length, int $offset) : array
    {
        // Return empty array if offset greater than total, (NB: offset is zero indexed, total is 1 indexed)
        if ($offset > $this->total - 1) {
            return [];
        }

        // ArrayObjects and \Iterators can be iterated directly
        // whereas \ArrayIterators return their iterator from getIterator()
        $iterator = method_exists($this->collection, 'getIterator') ?
            $this->collection->getIterator() :
            $this->collection;

        $slice = [];
        foreach (new \LimitIterator($iterator, $offset, $length) as $item) {
            $slice[] = $item;
        }
        return $slice;
    }
}