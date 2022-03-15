<?php namespace Logingrupa\Studybook\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\Studybook\Classes\Item\AvailableDateItem;
use Logingrupa\Studybook\Classes\Store\AvailableDateListStore;

/**
 * Class AvailableDateCollection
 * @package Logingrupa\Studybook\Classes\Collection
 */
class AvailableDateCollection extends ElementCollection
{
    const ITEM_CLASS = AvailableDateItem::class;

    /**
     * Apply filter by active field
     * @return $this
     */
    public function active()
    {
        $arResultIDList = AvailableDateListStore::instance()->active->get();

        return $this->intersect($arResultIDList);
    }
}
