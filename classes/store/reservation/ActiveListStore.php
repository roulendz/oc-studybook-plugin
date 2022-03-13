<?php namespace Logingrupa\Studybook\Classes\Store\Reservation;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Logingrupa\Studybook\Models\Reservation;

/**
 * Class ActiveListStore
 * @package Logingrupa\Studybook\Classes\Store\Reservation
 */
class ActiveListStore extends AbstractStoreWithoutParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB() : array
    {
        $arElementIDList = (array) Reservation::active()->lists('id');

        return $arElementIDList;
    }
}
