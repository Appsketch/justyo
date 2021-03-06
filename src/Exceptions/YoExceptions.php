<?php

namespace Appsketch\Justyo\Exceptions;

/**
 * Class YoExceptions
 *
 * @package Appsketch\Justyo\Exceptions
 */
class YoExceptions extends \Exception
{
    /**
     * @param string $key
     */
    public function __construct($key)
    {
        // message.
        $message = "The parameter \"$key\" is required and can not be null.";

        // Parent constructor.
        parent::__construct($message);
    }

}