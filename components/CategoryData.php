<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementData;
use Logingrupa\Studybook\Classes\Item\CategoryItem;

/**
 * Class CategoryData
 * @package Logingrupa\Studybook\Components
 */
class CategoryData extends ElementData
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.category_data_name',
            'description' => 'logingrupa.studybook::lang.component.category_data_description',
        ];
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @return CategoryItem
     */
    protected function makeItem($iElementID)
    {
        return CategoryItem::make($iElementID);
    }
}
