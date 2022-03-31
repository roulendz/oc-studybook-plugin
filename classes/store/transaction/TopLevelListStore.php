<?php namespace Logingrupa\Studybook\Classes\Store\Transaction;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Logingrupa\Studybook\Models\Transaction;

/**
 * Class TopLevelListStore
 * @package Logingrupa\Studybook\Classes\Store\Transaction
*/
class TopLevelListStore extends AbstractStoreWithoutParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB() : array
    {
        $arElementIDList = (array) Transaction::where('nest_depth', 0)
            ->orderBy('nest_left', 'asc')
            ->lists('id');

        return $arElementIDList;
    }
}
