<?php namespace Logingrupa\Studybook\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\Studybook\Classes\Item\ReservationItem;
use Logingrupa\Studybook\Classes\Store\ReservationListStore;

/**
 * Class ReservationCollection
 * @package Logingrupa\Studybook\Classes\Collection
 */
class ReservationCollection extends ElementCollection
{
    const ITEM_CLASS = ReservationItem::class;

    /**
     * Apply filter by active field
     * @return $this
     */
    public function active()
    {
        $arResultIDList = ReservationListStore::instance()->active->get();

        return $this->intersect($arResultIDList);
    }

    /**
     * Get item by code
     * @param string $sCode
     * @return ReservationItem
     */
    public function getByCode($sCode)
    {
        if ($this->isEmpty() || empty($sCode)) {
            return ReservationItem::make(null);
        }

        $arReservationList = $this->all();

        /** @var ReservationItem $obReservationItem */
        foreach ($arReservationList as $obReservationItem) {
            if ($obReservationItem->code == $sCode) {
                return $obReservationItem;
            }
        }

        return ReservationItem::make(null);
    }
}
