<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementData;
use Logingrupa\Studybook\Classes\Item\ReservationItem;

/**
 * Class ReservationData
 * @package Logingrupa\Studybook\Components
 */
class ReservationData extends ElementData
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.reservation_data_name',
            'description' => 'logingrupa.studybook::lang.component.reservation_data_description',
        ];
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @return ReservationItem
     */
    protected function makeItem($iElementID)
    {
        return ReservationItem::make($iElementID);
    }
}
