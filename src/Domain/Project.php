<?php

namespace Todo\Domain;

class Project
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var int
     */
    private $dueDate;

    /**
     * @var User
     */
    private $user;

    /**
     * @return int
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @param int
     * @return Project
     */
    public function setId ($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getDueDate ()
    {
        return $this->dueDate;
    }

    /**
     * @param int
     * @return Project
     */
    public function setDueDate ($dueDate)
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser ()
    {
        return $this->user;
    }

    /**
     * @param User
     * @return Project
     */
    public function setUser ($user)
    {
        $this->$user = $user;
        return $this;
    }
}