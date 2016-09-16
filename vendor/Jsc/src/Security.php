<?php
/**
 * Provides functionality for improving system security.
 *
 * Jason Snider's Website (http://jasonsnider.com)
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 *
 * @link http://jasonsnider.com
 *
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author Jason D Snider <jason@jasonsnider.com>
 *
 * @package JSC
 */
namespace Jsc;

/**
 * @author Jason D Snider <jason@jasonsnider.com>
 *
 * @package JSC
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
