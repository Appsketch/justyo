<?php

namespace Appsketch\Justyo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Yo
 *
 * @package Appsketch\Justyo\Facades
 */
class Yo extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Appsketch\Justyo\Yo';
    }

}