<?php


namespace Johnd\Paginator\Contracts;


/**
 * Interface PaginationInterface
 * Defines methods for creating a page of results from a collection
 * and returning information about the collection
 * @package Johnd\Paginator\Contracts
 */
interface PaginationInterface
{
    /**
     * Get the current page of elements
     */
    public function elements() : array;

    /**
     * Get the current page number
     */
    public function currentPage(): int;

    /**
     * Get the total number of pages in the collection
     */
    public function pages(): int;

    /**
     * Get the total count of elements in the collection
     */
    public function totalElements(): int;

    /**
     * Get the count of elements in the current page
     */
    public function totalElementsOnCurrentPage() : int;

    /**
     * Get the max number of elements per page
     */
    public function totalElementsPerPage() : int;

    /**
     * Get a single page of elements from a collection
     * @param int $pageNumber
     * @return array
     */
    public function paginate(int $pageNumber) : array;
}