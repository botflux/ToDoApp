<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 31/10/2017
 * Time: 22:58
 */

namespace Todo\DAO;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Todo\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{
    public function find ($id)
    {
        $sql = 'SELECT * FROM t_users WHERE t_users.usr_id=?';
        $row = $this->getDb()->fetchAssoc($sql, [$id]);

        if ($row){
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception(sprintf('No user matching id %s', $id));
        }
    }

    public function findAll ()
    {
        $sql = 'SELECT * FROM t_users';
        $rows = $this->getDb()->fetchAll($sql);

        $users = [];

        foreach ($rows as $row) {
            $users[] = $this->buildDomainObject($row);
        }

        return $users;
    }

    protected function buildDomainObject(array $row)
    {
        $user = new User();
        $user
            ->setId($row['usr_id'])
            ->setUsername($row['usr_name'])
            ->setPassword($row['usr_password'])
            ->setSalt($row['usr_salt'])
            ->setRole($row['usr_role']);

        return $user;
    }

    public function loadUserByUsername($username)
    {
        $sql = 'SELECT * FROM t_users WHERE usr_name=?';
        $row = $this->getDb()->fetchAssoc($sql, [$username]);

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new UsernameNotFoundException(sprintf('No user matching name %s', $username));
        }
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);

        if ($this->supportsClass($class)) {
            return $this->loadUserByUsername($user->getUsername());
        } else {
            throw new UnsupportedUserException(sprintf('Instances of %s are not supported.', $class));
        }
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }

    /**
     * @param string $username
     * @return boolean
     */
    public function usernameAlreadyTaken ($username)
    {
        $sql = 'SELECT * FROM t_users WHERE t_users.usr_name=?';
        $row = $this->getDb()->fetchAssoc($sql, [$username]);

        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param User $user
     */
    public function save (User $user)
    {
        $data = [
            'usr_id' => $user->getId(),
            'usr_name' => $user->getUsername(),
            'usr_password' => $user->getPassword(),
            'usr_salt' => $user->getSalt(),
            'usr_role' => $user->getRole(),
        ];

        if ($user->getId()) {
            $this->getDb()->update('t_users', $data, [
                'usr_id' => $user->getId()
            ]);
        } else {
            $this->getDb()->insert('t_users', $data);
            $user->setId($this->getDb()->lastInsertId());
        }
    }
}