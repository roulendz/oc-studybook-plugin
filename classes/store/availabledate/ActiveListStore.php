<?php namespace Logingrupa\Studybook\Classes\Store\AvailableDate;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Logingrupa\Studybook\Models\AvailableDate;

/**
 * Class ActiveListStore
 * @package Logingrupa\Studybook\Classes\Store\AvailableDate
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
        $arElementIDList = (array) AvailableDate::active()->lists('id');

        return $arElementIDList;
    }
}
