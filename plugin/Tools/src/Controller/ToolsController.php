<?php
/**
 * ToolsController.php.
 */
namespace Tools\Controller;

/**
 * ToolsController.
 */
class ToolsController extends \App\Controller\AppController
{
    /**
     * Provides an index for utilities.
     */
    public function index()
    {
    }

    /**
     * Accepts a user supplied string and passes it though every hash known to
     * PHP's hash_algos().
     */
    public function php_hashes()
    {
        $string = false;
        $userInput = filter_input_array(INPUT_POST);
        if (isset($userInput['string_to_hash'])) {
            $string = $userInput['string_to_hash'];
        }

        $this->View->vars = array(
            'string' => $string,
        );
    }

    /**
     * Displays random strings that are sutible for CakePHP salts and ciphers.
     */
    public function random_configuration_strings_for_cakephp()
    {
        $this->View->vars = array(
            'cipher' => $this->Jibirish->random('CAKECIPHER'),
            'salt' => $this->Jibirish->random('CAKESALT'),
        );
    }

    /**
     * Creates and displays a password based on user provided specs.
     */
    public function password_generator()
    {
        $length = 24;
        $upper = 'checked';
        $lower = 'checked';
        $numeric = 'checked';
        $special = 'checked';
        $requirements = null;

        $userInput = filter_input_array(INPUT_POST);

        if (!empty($userInput)) {
            if (isset($userInput['upper'])) {
                $requirements .= 'u';
            } else {
                $upper = false;
            }

            if (isset($userInput['lower'])) {
                $requirements .= 'l';
            } else {
                $lower = false;
            }

            if (isset($userInput['numeric'])) {
                $requirements .= 'n';
            } else {
                $numeric = false;
            }

            if (isset($userInput['special'])) {
                $requirements .= 's';
            } else {
                $special = false;
            }

            $length = $userInput['length'];
        }

        $this->View->vars = array(
            'length' => $length,
            'upper' => $upper,
            'lower' => $lower,
            'numeric' => $numeric,
            'special' => $special,
            'password' => $this->Jibirish->random($requirements, $length),
        );
    }

    /**
     * An action for analyzing a given string.
     */
    public function string_analyzer()
    {
        $userInput = filter_input_array(INPUT_POST);
        if (!empty($userInput)) {
            $this->View->vars = array(
                'character_count' => strlen($userInput['string']),
                'is_numeric' => is_numeric($userInput['string']) ? 'Yes' : 'No',
            );
        }
    }

    /**
     * A utilitity for showing meta data about a specific visitor.
     */
    public function who_am_i()
    {
        //$this->request->title = 'Who Am I?';
    }

    /**
     * Display information about a target location.
     */
    public function domain_and_ip_analysis()
    {
        $data = array();

        $userInput = filter_input_array(INPUT_POST);
        if (!empty($userInput)) {

            //We only want the raw domain or ip
            $host = parse_url($userInput['target']);

            if (empty($host['host'])) {
                $hostname = $host['path'];
            } else {
                $hostname = $host['host'];
            }

            $domainRegEx = '/^[a-zA-Z0-9][a-zA-Z0-9\-\_]+[a-zA-Z0-9]$/';

            //Use IP validation to determine what type of look up to perform
            if (filter_var($hostname, FILTER_FLAG_IPV4) || filter_var($hostname, FILTER_FLAG_IPV6)) {
                //Is an IP address
                $data['gethostbyaddr'] = gethostbyaddr($hostname);

                //Traceroute
                $traceRoute = shell_exec(escapeshellcmd("traceroute {$hostname}"));
                $data['traceRoute'] = $traceRoute;
            } elseif (preg_match($domainRegEx, $hostname) !== false) {
                //Is a host name
                $data['gethostbyname'] = gethostbyname($hostname);
                $data['gethostbynamel'] = gethostbynamel($hostname);

                //Traceroute
                $traceRoute = shell_exec(escapeshellcmd("traceroute {$hostname}"));
                $data['traceRoute'] = $traceRoute;
                //Whois
                $whois = shell_exec("whois {$hostname}");
                $data['whois'] = $whois;
            } else {
                die('Invalid format');
            }
        }

        $this->View->vars['data'] = $data;
    }
}
