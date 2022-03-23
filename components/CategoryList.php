<?php namespace Logingrupa\Studybook\Components;

use Cms\Classes\ComponentBase;
use Logingrupa\Studybook\Classes\Collection\CategoryCollection;

/**
 * Class CategoryList
 * @package Logingrupa\Studybook\Components
 */
class CategoryList extends ComponentBase
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.category_list_name',
            'description' => 'logingrupa.studybook::lang.component.category_list_description',
        ];
    }

    /**
     * Make element collection
     * @param array $arElementIDList
     * @return CategoryCollection
     */
    public function make($arElementIDList = null)
    {
        return CategoryCollection::make($arElementIDList);
    }

    /**
     * Method for ajax request with empty response
     * @return bool
     */
    public function onAjaxRequest()
    {
        return true;
    }
}
