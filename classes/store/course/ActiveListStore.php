<?php namespace Logingrupa\Studybook\Classes\Store\Course;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Logingrupa\Studybook\Models\Course;

/**
 * Class ActiveListStore
 * @package Logingrupa\Studybook\Classes\Store\Course
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
        $arElementIDList = (array) Course::active()->lists('id');

        return $arElementIDList;
    }
}
