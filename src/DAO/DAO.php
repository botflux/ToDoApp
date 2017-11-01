<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 31/10/2017
 * Time: 22:54
 */

namespace Todo\DAO;


use Doctrine\DBAL\Connection;

abstract class DAO
{
    /**
     * @var Connection
     */
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @return Connection
     */
    protected function getDb(): Connection
    {
        return $this->db;
    }

    /**
     * @param array $row
     * @return mixed
     */
    protected abstract function buildDomainObject (array $row);
}