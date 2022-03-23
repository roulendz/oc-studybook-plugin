<?php namespace Logingrupa\Studybook\Classes\Store\Category;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Logingrupa\Studybook\Models\Category;

/**
 * Class ActiveListStore
 * @package Logingrupa\Studybook\Classes\Store\Category
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
        $arElementIDList = (array) Category::active()->lists('id');

        return $arElementIDList;
    }
}
