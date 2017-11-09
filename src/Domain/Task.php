<?php

namespace Todo\Domain;

class Task
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
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $creationDate;

    /**
     * @var string
     */
    private $objectiveDate;

    /**
     * @var User
     */
    private $user;

    /**
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @param integer
     * @return Task
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @param string
     * @return Task
     */
    public function setName ($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent ()
    {
        return $this->content;
    }

    /**
     * @param string
     * @return Task
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreationDate ()
    {
        return $this->creationDate;
    }

    /**
     * @param string
     * @return Task
     */
    public function setCreationDate ($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getObjectiveDate()
    {
        return $this->objectiveDate;
    }

    /**
     * @param string
     * @return Task
     */
    public function setObjectiveDate($objectiveDate)
    {
        $this->objectiveDate = $objectiveDate;
        return $this;
    }

    /**
     * @param User
     * @return Task
     */
    public function setUser (User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser ()
    {
        return $this->user;
    }
}