<?php namespace Logingrupa\Studybook\Classes\Store\Company;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Logingrupa\Studybook\Models\Company;

/**
 * Class ActiveListStore
 * @package Logingrupa\Studybook\Classes\Store\Company
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
        $arElementIDList = (array) Company::active()->pluck('id')->all();

        return $arElementIDList;
    }
}
