<?php


namespace Johnd\Paginator\Collections;


use Johnd\Paginator\Contracts\CollectionInterface;
use Johnd\Paginator\Contracts\DbConnectionInterface;

/**
 * DbCollection example
 *
 * Extend this class and pass a DB connection to the constructor.
 * Then implement getTotal() and getSubset() in the child class
 *
 * @package Johnd\Paginator
 * @implements CollectionInterface
 */
class DbCollection implements CollectionInterface
{
    /**
     * @var
     */
    protected $dbConnection;


    /**
     * @param DbConnectionInterface $dbConnection
     */
    public function __construct(DbConnectionInterface $dbConnection)
    {
        $this->dbConnection = $dbConnection->get();
    }

    /**
     * @return int
     */
    public function getTotal() : int
    {
        // Eg
        // $this->dbConnection->query('SELECT count(*) FROM foo;');
    }

    /**
     * @param int $length
     * @param int $offset
     * @return array
     */
    public function getSubset($length, $offset) : array
    {
        // Eg
        // $this->dbConnection->prepare('SELECT * FROM foo LIMIT ?, ?');
    }
}