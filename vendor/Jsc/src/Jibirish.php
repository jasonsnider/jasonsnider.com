<?php
/**
 * Jibirish.php.
 */
namespace Jsc;

/**
 * Jibirish.
 * 
 * A library for creating jiberish, as in psuedo-random strings, salt, hashes
 * and noise.
 */
class Jibirish
{
    /**
     * Generates a random string of a specified length and character set.
     *
     * @param int         $length       The length of the string
     * @param bool        $upper        Add the A-Z character set
     * @param bool        $lower        Add the a-z character set
     * @param bool        $numeric      Add the numeric character set
     * @param bool        $special      Add the special character set
     * @param bool        $disambiguate Removes potentially ambiguous characters from the alphabets
     * @param bool|string $custom       allows the use of a custom character set
     *
     * @return string
     */
    private function __randomizer($length, $upper, $lower, $numeric, $special, $disambiguate, $custom = false)
    {
        $characters = '';
        $string = '';

        if ($numeric) {
            $characters .= ($disambiguate) ? '23456789' : '0123456789';
        }

        if ($lower) {
            $characters .= ($disambiguate) ? 'abcdefghijmnpqrstuvwxyz' : 'abcdefghijklmnopqrstuvwxyz';
        }

        if ($upper) {
            $characters .= ($disambiguate) ? 'ABCDEFGHLMNPQRSTUVWXYZ' : 'ABCDEFGHIKLMNOPQRSTUVWXYZ';
        }

        if ($special) {
            $characters .= ($disambiguate) ? '!@#$%^&*()-_=+;:\'"<>,./?\\`~' : '!@#$%^&*()-_=+;:\'"<>,./?\\`~';
        }

        if ($custom) {
            $characters .= $custom;
        }

        $size = strlen($characters);

    //try to increase entropy by shuffling the character set
    $characters .= str_shuffle($characters);

        for ($i = 0; $i < $length; ++$i) {
            $string .= $characters[mt_rand(0, $size - 1)];
        }

        return $string;
    }

    /**
     * Returns a random string matching the input requirements. These requirements may consist of custom or predefined
     * types.
     *
     * Predefined Random String Types
     *
     * - CAKECIPHER returns a CakePHP cipher string
     * - CAKESALT returns a CakePHP salt string
     *
     * Custom Random String Types
     * Passing a string consiting of any of the following characters. For example Utility::random('ul', 10); will
     * return a 10 character string containing upper and lower case letters.
     *
     * - u Calls the uppercase character set
     * - l Calls the lowercase character set
     * - n Calls the numeric character set
     * - s Calls the special character set
     * - d Disambiguate all character sets
     *
     * @param string $type
     * @param int    $length
     *
     * @return string
     */
    public function random($type = null, $length = null)
    {

        //If no string is passed, set the default string type
        if (is_null($type)) {
            $type = 'ulnsd';
        }

        //If the string is not all caps we will parse it for args, otherwise we assume it's a predefined type
        if (!ctype_upper($type)) {
            $chars = str_split($type);

            $upper = in_array('u', $chars) ? true : false;
            $lower = in_array('l', $chars) ? true : false;
            $numeric = in_array('n', $chars) ? true : false;
            $special = in_array('s', $chars) ? true : false;
            $disambiguate = in_array('d', $chars) ? true : false;

            return $this->__randomizer($length, $upper, $lower, $numeric, $special, $disambiguate);
        }

        //If we have made it this far, try and set a default type
        switch ($type) {
            //$this->__randomizer($length, $upper, $lower, $numeric, $special, $disambiguate);
            case 'CAKECIPHER':
                return $this->__randomizer(128, false, false, true, false, false);
            break;

            case 'CAKESALT':
                return $this->__randomizer(128, true, true, true, false, false, '!@#$%^&*()-_=+;:<>,./?`~');
            break;
        }
    }

    /**
     * Returns a large high entropy string.
     *
     * @return string
     */
    public function entropy()
    {
        //$seed will pad itself with more and more psuedo-random data
        //$salt is a hash of seed, it will use a 512-bit hash to digest the seed. it will then use multiple (and only)
        //512 bit algos. to redigest the salt value until a high number of passes have been made.

        //Generate some entropy
        $seed = openssl_random_pseudo_bytes(4096);

        //While it might seem silly, it is entropy.
        $seed .= (mt_getrandmax() / rand());

        //Use Tinker's random uuid generator to add more entropy
        for ($i = 0; $i < 10; ++$i) {
            $seed .= $this->uuid();
        }

        //Use mt_rand to pad the seed out with more entropy
        $seed .= mt_rand(1000000000, 2147483647);

        //Create a really large psuedo-random string for more entropy
        $seed .= $this->random(4096, 'ulns');

        //Hash php.ini to add more entropy
        $seed .= hash('sha512', php_ini_loaded_file());

        //read from dev rand to create more entropy
        //@link http://www.php.net/manual/en/function.uniqid.php#88023
        $fp = @fopen('/dev/urandom', 'rb');
        if ($fp !== false) {
            $seed .= @fread($fp, 16);
            @fclose($fp);
        }

        //Use mt_rand() to add more entropy to the seed
        //@link http://www.php.net/manual/en/function.uniqid.php#88023
        for ($i = 0; $i < 16; ++$i) {
            $seed .= chr(mt_rand(0, 255));
        }

        //More entropy
        //http://stackoverflow.com/questions/9883359/gathering-entropy-in-web-apps-to-create-more-secure-random-numbers
        $noise = microtime()
            .serialize($_SERVER)
            .serialize($_POST)
            .serialize($_GET)
            .serialize($_COOKIE);

        $seed .= hash('sha512', $noise);
        $seed .= hash('whirlpool', $noise);

        if (is_dir(DS.'var')) {
            $seed .= hash('sha512', implode(scandir(DS.'var')));
            $seed .= hash('whirlpool', implode(scandir(DS.'var')));
        }

        return $seed;
    }

    /**
     * Returns 512 bits of psuedo-random noise.
     *
     * @return string A 512 bit psuedo-random string
     */
    public function salt()
    {
        $seed = $this->entropy();

        $salt = $hash = hash('sha512', $seed);
        $salt = hash('whirlpool', $salt);

        for ($i = 0; $i < 10; ++$i) {
            $salt = hash('sha512', $salt);
            $salt = hash('whirlpool', $salt);
        }

        return $salt;
    }

    /**
     * Generates a  version 4 compliant psuedo-random UUID.
     *
     * @link http://www.php.net/manual/en/function.uniqid.php#88023
     * @see http://tools.ietf.org/html/rfc4122#section-4.4
     * @see http://en.wikipedia.org/wiki/UUID
     *
     * @return string A UUID, made up of 32 hex digits and 4 hyphens.
     */
    public function uuid()
    {
        $pr_bits = null;
        $fp = @fopen('/dev/urandom', 'rb');
        if ($fp !== false) {
            $pr_bits .= @fread($fp, 16);
            @fclose($fp);
        } else {
            // If /dev/urandom isn't available (eg: in non-unix systems), use mt_rand().
            $pr_bits = '';
            for ($cnt = 0; $cnt < 16; ++$cnt) {
                $pr_bits .= chr(mt_rand(0, 255));
            }
        }

        $time_low = bin2hex(substr($pr_bits, 0, 4));
        $time_mid = bin2hex(substr($pr_bits, 4, 2));
        $time_hi_and_version = bin2hex(substr($pr_bits, 6, 2));
        $clock_seq_hi_and_reserved = bin2hex(substr($pr_bits, 8, 2));
        $node = bin2hex(substr($pr_bits, 10, 6));

        /*
         * Set the four most significant bits (bits 12 through 15) of the
         * time_hi_and_version field to the 4-bit version number from
         * Section 4.1.3.
         * @see http://tools.ietf.org/html/rfc4122#section-4.1.3
         */
        $time_hi_and_version = hexdec($time_hi_and_version);
        $time_hi_and_version = $time_hi_and_version >> 4;
        $time_hi_and_version = $time_hi_and_version | 0x4000;

        /*
         * Set the two most significant bits (bits 6 and 7) of the
         * clock_seq_hi_and_reserved to zero and one, respectively.
         */
        $clock_seq_hi_and_reserved = hexdec($clock_seq_hi_and_reserved);
        $clock_seq_hi_and_reserved = $clock_seq_hi_and_reserved >> 2;
        $clock_seq_hi_and_reserved = $clock_seq_hi_and_reserved | 0x8000;

        return sprintf(
            '%08s-%04s-%04x-%04x-%012s',
            $time_low,
            $time_mid,
            $time_hi_and_version,
            $clock_seq_hi_and_reserved,
            $node
        );
    }
}
