<?php
/**
 * Created by PhpStorm.
 * User: maartenpaauw
 * Date: 07-07-15
 * Time: 21:24
 */

namespace M44rt3np44uw\Justyo;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use M44rt3np44uw\Justyo\Exceptions\YoExceptions;

/**
 * Class Yo
 *
 * @package M44rt3np44uw\Justyo
 */
class Yo {

    /**
     * API URL
     */
    const API_URL = "http://api.justyo.co/";

    /**
     * PARAMETERS
     */
    const PARAMETERS = array(
        'api_token',
        'callback_url',
        'description',
        'email',
        'link',
        'location',
        'needs_location',
        'password',
        'welcome_link',
        'username'
    );

    /**
     * @var
     */
    private $options;

    /**
     * @var
     */
    private $client;

    /**
     * @var
     */
    private $api_url;


    /**
     * Get options.
     *
     * @param $array_key
     *
     * @return array
     */
    public function getOptions($array_key = null)
    {
        // Check if the array key isset and not empty.
        if(isset($array_key) && !empty($array_key))
        {
            // Set options with prefix key.
            $options = [$array_key => $this->options];
        }

        else
        {
            // Set the current options.
            $options = $this->options;
        }

        // Return the options.
        return $options;
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
    public function mergeOptions($options = [])
    {
        // Check if the options isset and not empty.
        if(isset($options) && !empty($options))
        {
            // Merge the options with the current options.
            $this->setOptions(array_filter(array_merge($this->getOptions(), $options)));
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
     * @param Client $client
     *
     * @throws YoExceptions
     */
    public function __construct(Client $client)
    {
        // Set the client.
        $this->client = $client;

        // Initialize the options array.
        $this->initOptions();

        // Check the config array.
        $this->checkOptions(['api_token']);
    }

    /**
     * Set the account to use.
     *
     * If the account don't exists in the accounts array
     * The default will be used.
     *
     * @param $account
     *
     * @return $this
     */
    public function account($account)
    {
        // Uppercase account.
        $account = strtoupper($account);

        // Get all the accounts from the config file.
        $accounts = Config::get('yo.accounts');

        // Check if the accounts array isset and not empty.
        if(isset($accounts) && !empty($accounts) && is_array($accounts))
        {
            // Check if the given account exists.
            if(array_key_exists($account, $accounts))
            {
                // Update the new api_token.
                $this->mergeOptions(['api_token' => $accounts[$account]]);
            }
        }

        // Check the options array.
        $this->checkOptions(['api_token']);

        // Return this.
        return $this;
    }

    /**
     * Yo a specific user.
     *
     * @param      $username
     * @param null $link_or_location
     *
     * @return mixed
     * @throws YoExceptions
     */
    public function user($username, $link_or_location = null)
    {
        // Merge the username to the options array.
        $this->setUsername($username);

        // Check the options array.
        $this->checkOptions(['username']);

        // Set the link or location
        $this->setLinkOrLocation($link_or_location);

        // Set the API url.
        $this->setApiUrl('yo/');

        // Return result.
        return $this->post();
    }

    /**
     * Send a Yo to multiple users.
     *
     * @param array $users
     * @param null  $link_or_location
     *
     * @return array|string
     */
    public function users($users = [], $link_or_location = null)
    {
        // Result
        $results = [];

        // Check if the users array isset and not empty.
        if(isset($users) && !empty($users) && is_array($users))
        {
            // Loop through the users.
            foreach ($users as $count => $username)
            {
                // Send a Yo for each user.
                $result = json_decode($this->user($username, $link_or_location));

                // Update the results array.
                $results[$count] = $result;
            }
        }

        // JSON encode.
        $results = json_encode($results);

        // Return the results.
        return $results;
    }

    /**
     * Yo all the subscribers.
     *
     * @param null $link
     *
     * @return mixed
     */
    public function all($link = null)
    {
        // Check if the given parameter is a valid url.
        if(Yo::isUrl($link))
        {
            // Merge the link to the options array.
            $this->mergeOptions(['link' => $link]);
        }

        // Set the API url.
        $this->setApiUrl('yoall/');

        // Return result.
        return $this->post();
    }

    /**
     * Create an account.
     *
     * @param       $username
     * @param array $account_data
     *
     * @return mixed
     * @throws YoExceptions
     */
    public function createAccount($username, $account_data = [])
    {
        // Merge the username to the options array.
        $this->setUsername($username);

        // Check the options array.
        $this->checkOptions(['username']);

        // Set the API url.
        $this->setApiUrl('accounts/');

        // Account data
        $this->setAccountData($account_data);

        // Return result.
        return $this->post();
    }

    /**
     * An alias for createAccount.
     *
     * @param       $username
     * @param array $account_data
     *
     * @return mixed
     */
    public function create($username, $account_data = [])
    {
        return $this->createAccount($username, $account_data);
    }

    /**
     * Check the username.
     *
     * @param $username
     *
     * @return mixed
     * @throws YoExceptions
     */
    public function checkUsername($username)
    {
        // Merge the username to the options array.
        $this->setUsername($username);

        // Check the options array.
        $this->checkOptions(['username']);

        // Set the API url.
        $this->setApiUrl('check_username/');

        // Return result.
        return $this->get();
    }

    /**
     * An alias for checkUsername.
     *
     * @param $username
     *
     * @return mixed
     */
    public function check($username)
    {
        return $this->checkUsername($username);
    }

    /**
     * Get the subscribers count.
     *
     * @return mixed
     */
    public function subscribers()
    {
        // Set the API url.
        $this->setApiUrl('subscribers_count/');

        // Return result.
        return $this->get();
    }

    /**
     * Initialize the options array.
     */
    private function initOptions()
    {
        // Get config options.
        $config_options = Config::get('yo.api_token');

        // Push the config options to the options array.
        $this->setOptions(['api_token' => $config_options]);
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
            if(!array_key_exists($required_option, $options) || !isset($options[$required_option]) || empty($options[$required_option]))
            {
                // Throw exception.
                throw new YoExceptions($required_option);
            }
        }
    }

    /**
     * Merge the username to the options array.
     *
     * @param $username
     *
     * @return string
     */
    private function setUsername($username)
    {
        // Uppercase the username.
        $username = strtoupper($username);

        // Merge username to the options array.
        $this->mergeOptions(['username' => $username]);
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
            if(Yo::isUrl($link_or_location))
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
     * Set the account data.
     *
     * @param array $account_data
     */
    private function setAccountData($account_data = [])
    {
        // Check if the data isset and not empty.
        if(isset($account_data) && !empty($account_data))
        {
            // Get the fillable parameters.
            $parameters = Yo::PARAMETERS;

            // Loop through the given options.
            foreach ($account_data as $parameter => $value)
            {
                // If the key is not a valid parameter unset it.
                if(!in_array($parameter, $parameters))
                {
                    // Unset the non valid options.
                    unset($account_data[$parameter]);
                }
            }

            // Merge the options to the options array.
            $this->mergeOptions($account_data);
        }
    }

    /**
     * Post request.
     *
     * @return mixed
     */
    private function post()
    {
        // The post result.
        $result = $this->client->post($this->getApiUrl(), $this->getOptions('form_params'));

        // Return result.
        return $result->getBody();
    }

    /**
     * Get request.
     *
     * @return mixed
     */
    private function get()
    {
        // The get result.
        $result = $this->client->get($this->getApiUrl(), $this->getOptions('query'));

        // Return result.
        return $result->getBody();
    }

    /**
     * Check if the given string is a valid url.
     *
     * @param $url
     *
     * @return bool
     */
    private static function isUrl($url)
    {
        // Return if url.
        return (bool)filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Check if the given string is a long;lat string.
     *
     * @param $long_lat
     *
     * @return bool
     */
    private static function isLongLat($long_lat)
    {
        // Return if long;lat.
        return (bool)preg_match('/^(?<latitude>[-]?[0-8]?[0-9]\.\d+|[-]?90\.0+?)(?<delimeter>.)(?<longitude>[-]?1[0-7][0-9]\.\d+|[-]?[0-9]?[0-9]\.\d+|[-]?180\.0+?)$/', $long_lat);
    }

}