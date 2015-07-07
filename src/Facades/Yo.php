<?php
/**
 * Created by PhpStorm.
 * User: maartenpaauw
 * Date: 07-07-15
 * Time: 21:27
 */

namespace M44rt3np44uw\Yolaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Yo
 *
 * @package M44rt3np44uw\Yolaravel\Facades
 */
class Yo extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yo';
    }

}