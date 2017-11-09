<?php

namespace Todo\DAO;


use Todo\Domain\Task;

class TaskDAO extends DAO
{
    private $userDao;

    /**
     * @param UserDAO
     * @return TaskDAO
     */
    public function setUserDao (UserDAO $userDao)
    {
        $this->userDao = $userDao;
        return $this;
    }

    /**
     * @param array
     * @return Task
     */
    public function buildDomainObject (array $row)
    {
        $task = new Task();
        $task
            ->setId($row['tsk_id'])
            ->setName($row['tsk_name'])
            ->setContent($row['tsk_content'])
            ->setCreationDate($row['tsk_cdate'])
            ->setObjectiveDate($row['tsk_odate'])
            ->setUser($this->userDao->find($row['usr_id']));

        return $task;
    }

    /**
     * @return array
     */
    public function findAll ()
    {
        $sql = 'SELECT * FROM t_tasks';
        $rows = $this->getDb()->fetchAll($sql);

        $tasks = [];

        foreach ($rows as $row)
        {
            $tasks[] = $this->buildDomainObject($row);
        }

        return $tasks;
    }

    /**
     * @param integer
     * @return Task
     */
    public function find ($id) 
    {
        $sql = 'SELECT * FROM t_tasks WHERE tsk_id = ?';
        $row = $this->getDb()->fetchAssoc($sql, [$id]);

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception (sprintf('No task matching id %s', $id));
        }
    }
}