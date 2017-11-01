<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 31/10/2017
 * Time: 22:49
 */

namespace Todo\Domain;


use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     * VALUES: ROLE_USER or ROLE_ADMIN
     */
    private $role;

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $salt
     * @return User
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return User
     */
    public function setRole(string $role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    public function getRoles() : array
    {
        return [$this->getRole()];
    }
}