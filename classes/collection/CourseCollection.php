<?php namespace Logingrupa\Studybook\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\Studybook\Classes\Item\CourseItem;
use Logingrupa\Studybook\Classes\Store\CourseListStore;

/**
 * Class CourseCollection
 * @package Logingrupa\Studybook\Classes\Collection
 */
class CourseCollection extends ElementCollection
{
    const ITEM_CLASS = CourseItem::class;

    /**
     * Apply filter by active field
     * @return $this
     */
    public function active()
    {
        $arResultIDList = CourseListStore::instance()->active->get();

        return $this->intersect($arResultIDList);
    }

    /**
     * Get item by code
     * @param string $sCode
     * @return CourseItem
     */
    public function getByCode($sCode)
    {
        if ($this->isEmpty() || empty($sCode)) {
            return CourseItem::make(null);
        }

        $arCourseList = $this->all();

        /** @var CourseItem $obCourseItem */
        foreach ($arCourseList as $obCourseItem) {
            if ($obCourseItem->code == $sCode) {
                return $obCourseItem;
            }
        }

        return CourseItem::make(null);
    }
}
