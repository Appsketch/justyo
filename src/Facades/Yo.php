<?php
/**
 * Created by PhpStorm.
 * User: maartenpaauw
 * Date: 07-07-15
 * Time: 21:27
 */

namespace M44rt3np44uw\Justyo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Yo
 *
 * @package M44rt3np44uw\Justyo\Facades
 */
class Yo extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'M44rt3np44uw\Justyo\Yo';
    }

}