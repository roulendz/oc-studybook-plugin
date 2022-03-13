<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementPage;
use Logingrupa\Studybook\Models\Reservation;
use Logingrupa\Studybook\Classes\Item\ReservationItem;

/**
 * Class ReservationPage
 * @package Logingrupa\Studybook\Components
 */
class ReservationPage extends ElementPage
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.reservation_page_name',
            'description' => 'logingrupa.studybook::lang.component.reservation_page_description',
        ];
    }

    /**
     * Get element object
     * @param string $sElementSlug
     * @return Reservation
     */
    protected function getElementObject($sElementSlug)
    {
        if (empty($sElementSlug)) {
            return null;
        }

        $obElement = Reservation::active()->getBySlug($sElementSlug)->first();

        if(!empty($obElement)) {
            $obElement->view_count++;
            $obElement->save();
        }

        return $obElement;
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @param Reservation $obElement
     * @return ReservationItem
     */
    protected function makeItem($iElementID, $obElement)
    {
        return ReservationItem::make($iElementID, $obElement);
    }
}
