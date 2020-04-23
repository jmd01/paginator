<?php

namespace Johnd\Paginator\Contracts;


interface DbConnectionInterface
{
    /**
     * Get the DB connection
     * @return mixed
     */
    public function get();
}