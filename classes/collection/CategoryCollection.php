<?php namespace Logingrupa\Studybook\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\Studybook\Classes\Item\CategoryItem;
use Logingrupa\Studybook\Classes\Store\CategoryListStore;

/**
 * Class CategoryCollection
 * @package Logingrupa\Studybook\Classes\Collection
 */
class CategoryCollection extends ElementCollection
{
    const ITEM_CLASS = CategoryItem::class;

    /**
     * Apply filter by active field
     * @return $this
     */
    public function active()
    {
        $arResultIDList = CategoryListStore::instance()->active->get();

        return $this->intersect($arResultIDList);
    }

    /**
     * Sort list
     * @return $this
     */
    public function tree()
    {
        $arResultIDList = CategoryListStore::instance()->top_level->get();

        return $this->applySorting($arResultIDList);
    }
}
