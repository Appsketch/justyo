<?php
/**
 * Created by PhpStorm.
 * User: maartenpaauw
 * Date: 07-07-15
 * Time: 21:24
 */

namespace M44rt3np44uw\Yolaravel;

use Illuminate\Support\Facades\Config;
use M44rt3np44uw\Yolaravel\Exceptions\YoExceptions;

/**
 * Class Yo
 *
 * @package M44rt3np44uw\Yolaravel
 */
class Yo {

    /**
     * API URL
     */
    const API_URL = "http://api.justyo.co/";

    /**
     * @var
     */
    private $options;

    /**
     * @var
     */
    private $api_url;

    /**
     * Get options.
     *
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set options.
     *
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * Merge options.
     *
     * @param $options
     */
    public function mergeOptions($options)
    {
        if(isset($options) && !empty($options))
        {
            $this->setOptions(array_merge($this->getOptions(), $options));
        }
    }

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * @param mixed $api_url
     */
    public function setApiUrl($api_url)
    {
        $this->api_url = Yo::API_URL . $api_url;
    }

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        // Initialize the options array.
        $this->initOptions();

        // Check the config array.
        $this->checkOptions(['api_key']);
    }

    public function user($username, $link_or_location = null)
    {
        // Username.
        $username = $this->username($username);

        // Merge username to the options array.
        $this->mergeOptions(['username' => $username]);

        // Check the options array.
        $this->checkOptions(['username']);

        // Set the link or location
        $this->setLinkOrLocation($link_or_location);

        // Set the API url.
        $this->setApiUrl('yo/');
    }

    public function all()
    {

    }

    public function createAccount()
    {

    }

    public function checkUsername()
    {

    }

    public function subscribers()
    {

    }

    private function initOptions()
    {
        // Get config options.
        $config_options = Config::get('yo');

        // Push the config options to the options array.
        $this->setOptions($config_options);
    }

    /**
     * @param array $required_options
     *
     * @throws YoExceptions
     */
    private function checkOptions($required_options = [])
    {
        // Get the options.
        $options = $this->getOptions();

        // Loop through all the required options.
        foreach ($required_options as $required_option)
        {
            // Throw exception if the key is not set.
            if(!array_key_exists($required_option, $options) && !isset($options[$required_option]) && empty($options[$required_option]))
            {
                // Throw exception.
                throw new YoExceptions($required_option);
            }
        }
    }

    /**
     * Edit the username.
     *
     * @param $username
     *
     * @return string
     */
    private function username($username)
    {
        // Uppercase the username.
        $username = strtoupper($username);

        // Return the username.
        return $username;
    }

    /**
     * Merge the link or location option to the options array.
     *
     * @param $link_or_location
     */
    private function setLinkOrLocation($link_or_location)
    {
        // Check if the link or location isset and not empty.
        if(isset($link_or_location) && !empty($link_or_location))
        {
            // Check if the parameter is a link.
            if(Yo::isLink($link_or_location))
            {
                // Push the link to the options array.
                $this->mergeOptions(['link' => $link_or_location]);
            }

            // Check if the parameter is a location.
            else if(Yo::isLongLat($link_or_location))
            {
                // Push the location to the options array.
                $this->mergeOptions(['location' => $link_or_location]);
            }
        }
    }

    /**
     * @param $link
     *
     * @return bool
     */
    private static function isLink($link)
    {
        return (bool)filter_var($link, FILTER_VALIDATE_URL);
    }

    /**
     * @param $long_lat
     *
     * @return bool
     */
    private static function isLongLat($long_lat)
    {
        return (bool)preg_match('/^(?<latitude>[-]?[0-8]?[0-9]\.\d+|[-]?90\.0+?)(?<delimeter>.)(?<longitude>[-]?1[0-7][0-9]\.\d+|[-]?[0-9]?[0-9]\.\d+|[-]?180\.0+?)$/', $long_lat);
    }

}