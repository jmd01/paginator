<?php


namespace Johnd\Paginator;


use Johnd\Paginator\Contracts\CollectionInterface;
use Johnd\Paginator\Contracts\PaginationInterface;

/**
 * Class Paginator
 * @package Johnd\Paginator
 * @implements PaginationInterface
 */
class Paginator implements PaginationInterface
{
    protected $collection;
    protected $perPage = 0;
    protected $currentPage = 0;
    protected $pageElements = [];
    protected $totalElements;

    public function __construct(CollectionInterface $collection, int $perPage)
    {
        $this->perPage = $perPage;
        $this->collection = $collection;
    }

    public function elements() : array
    {
        return $this->pageElements;
    }

    public function currentPage() : int
    {
        return $this->currentPage;
    }

    public function pages() : int
    {
        return ceil($this->totalElements() / $this->perPage);
    }

    public function totalElements() : int
    {
        $this->totalElements = $this->totalElements ?? $this->collection->getTotal();
        return $this->totalElements;
    }

    public function totalElementsOnCurrentPage() : int
    {
        return count($this->pageElements);
    }

    public function totalElementsPerPage() : int
    {
        return $this->perPage;
    }

    public function paginate($pageNumber) : array
    {
        $this->currentPage = $pageNumber;

        $offset = ($pageNumber-1) * $this->perPage;

        $this->pageElements = $this->collection->getSubset($this->perPage, $offset);

        return [
            'pageElements' => $this->elements(),
            'currentPage' => $this->currentPage(),
            'perPage' => $this->totalElementsPerPage(),
            'totalElements' => $this->totalElements(),
            'elementsOnPage' => $this->totalElementsOnCurrentPage()
        ];
    }
}