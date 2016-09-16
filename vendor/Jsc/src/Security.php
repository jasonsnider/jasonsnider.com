<?php
/**
 * Security.php.
 */
namespace Jsc;

/**
 * Security.
 *
 * Provides functionality for improving system security.
 */
class Security
{
    /**
     * Creates a hash that represents a users password.
     *
     * @param string $password   The string the user has submitted as their password.
     * @param string $userSalt   Each user should have their own unique salt value.
     * @param string $systemSalt An application should have it's own salt value
     *
     * @return string
     */
    public function password($password, $userSalt, $systemSalt)
    {
        $preHash = $password.$userSalt.$systemSalt;

        $hash = hash('sha512', $preHash);
        $hash = hash('whirlpool', $hash);

        for ($i = 0; $i < 10; ++$i) {
            $hash = hash('sha512', $hash);
            $hash = hash('whirlpool', $hash);
        }

        return $hash;
    }
}
