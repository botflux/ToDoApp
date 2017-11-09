<?php

namespace Todo\Generator;

use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class PasswordGenerator
{
    /**
     * @var BCryptPasswordEncoder
     */
    private $encoder;

    public function __construct ()
    {
        $this->encoder = new \Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder(13);
        
    }

    /**
     * @return string
     */
    public function generateRandomSalt ()
    {
        $randomBinaryString = random_bytes(23);
        $salt = password_hash($randomBinaryString, \PASSWORD_BCRYPT);
        $salt = substr($salt,0,23);

        return $salt;
    }

    /**
     * @param string raw password
     * @param string salt
     * @return string encoded password
     */
    public function generateHash ($raw, $salt)
    {
        $hash = $this->encoder->encodePassword($raw, $salt);
        return $hash;
    }

    /**
     * @param string hashed password
     * @param string raw password
     * @param string salt
     * @return bool
     */
    public function isValid ($hash, $raw, $salt)
    {
        return $this->encoder->isPasswordValid($hash, $raw, $salt);
    }
}