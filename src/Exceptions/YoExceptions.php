<?php
/**
 * Created by PhpStorm.
 * User: maartenpaauw
 * Date: 07-07-15
 * Time: 22:03
 */

namespace M44rt3np44uw\Justyo\Exceptions;

/**
 * Class YoExceptions
 *
 * @package M44rt3np44uw\Justyo\Exceptions
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