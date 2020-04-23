<?php


namespace Johnd\Paginator\Contracts;


/**
 * Interface CollectionInterface
 * Defines methods for providing data about the collection used by the Paginator
 * @package Johnd\Paginator\Contracts
 */
interface CollectionInterface
{
    /**
     * Get the total count of items in the collection
     */
    public function getTotal() : int;

    /**
     * Get a subset of the collection of $length, starting from $offset
     * @param int $length
     * @param int $offset
     * @return array
     */
    public function getSubset(int $length, int $offset) : array;
}