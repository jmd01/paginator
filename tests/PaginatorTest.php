<?php

namespace Johnd\Paginator;

use Johnd\Paginator\Collections\IterableCollection;
use PHPUnit\Framework\TestCase;

class PaginatorTest extends TestCase
{
    protected $input;

    protected function setUp(): void
    {
        $this->input = ['alpha', 'beta', 'delta', 'gamma'];
    }

    public function testElements()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 2;
        $pageNumber = 1;

        $paginator = new Paginator($collection, $perPage);
        $paginator->paginate($pageNumber);

        $result = $paginator->elements();

        $this->assertIsArray($result);
        $this->assertEquals(['alpha', 'beta'], $result);
    }

    public function testCurrentPageInitiallyZero()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 2;

        $paginator = new Paginator($collection, $perPage);

        $currentPage = $paginator->currentPage();

        $this->assertEquals(0, $currentPage);
    }

    public function testCurrentPageChangesOnPaginate()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 2;
        $pageNumber = 1;

        $paginator = new Paginator($collection, $perPage);
        $paginator->paginate($pageNumber);

        $currentPage = $paginator->currentPage();

        $this->assertEquals($pageNumber, $currentPage);
    }

    public function testPages()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 2;

        $paginator = new Paginator($collection, $perPage);

        $pages = $paginator->pages();

        $this->assertEquals(2, $pages);
    }

    public function testTotalElements()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 2;

        $paginator = new Paginator($collection, $perPage);

        $total = $paginator->totalElements();

        $this->assertEquals(4, $total);
    }

    public function testTotalElementsOnCurrentPage()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 3;
        $pageNumber = 1;

        // Get page 1
        $paginator = new Paginator($collection, $perPage);
        $paginator->paginate($pageNumber);

        $total = $paginator->totalElementsOnCurrentPage();

        $this->assertEquals(3, $total);

        // Get next page
        $paginator = new Paginator($collection, $perPage);
        $paginator->paginate($pageNumber + 1);

        $total = $paginator->totalElementsOnCurrentPage();

        $this->assertEquals(1, $total);
    }

    public function testTotalElementsPerPage()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 2;

        $paginator = new Paginator($collection, $perPage);

        $total = $paginator->totalElementsPerPage();

        $this->assertEquals(2, $total);
    }

    public function testPaginationOverMultiplePages()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 2;
        $pageNumber = 1;

        // Get page 1
        $paginator = new Paginator($collection, $perPage);
        $paginator->paginate($pageNumber);

        $result = $paginator->elements();

        $this->assertIsArray($result);
        $this->assertEquals(['alpha', 'beta'], $result);

        // Get the next page
        $paginator->paginate($pageNumber + 1);

        $result = $paginator->elements();

        $this->assertIsArray($result);
        $this->assertEquals(['delta', 'gamma'], $result);
    }

    public function testPaginationPartialResultOnLastPage()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 3;
        $pageNumber = 2;

        $paginator = new Paginator($collection, $perPage);
        $paginator->paginate($pageNumber);

        $result = $paginator->elements();

        $this->assertIsArray($result);
        $this->assertEquals(['gamma'], $result);
    }

    public function testPaginationReturnStructure()
    {
        $collection = new IterableCollection($this->input);

        $perPage = 2;
        $pageNumber = 1;

        $paginator = new Paginator($collection, $perPage);
        $result = $paginator->paginate($pageNumber);

        $this->assertIsArray($result);

        $this->assertEquals(['alpha', 'beta'], $result['pageElements']);
        $this->assertEquals(1, $result['currentPage']);
        $this->assertEquals(2, $result['perPage']);
        $this->assertEquals(4, $result['totalElements']);
        $this->assertEquals(2, $result['elementsOnPage']);
    }

}
