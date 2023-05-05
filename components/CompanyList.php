<?php namespace Logingrupa\Studybook\Components;

use Cms\Classes\ComponentBase;
use Logingrupa\Studybook\Classes\Collection\CompanyCollection;

/**
 * Class CompanyList
 * @package Logingrupa\Studybook\Components
 */
class CompanyList extends ComponentBase
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.company_list_name',
            'description' => 'logingrupa.studybook::lang.component.company_list_description',
        ];
    }

    /**
     * Make element collection
     * @param array $arElementIDList
     * @return CompanyCollection
     */
    public function make($arElementIDList = null)
    {
        return CompanyCollection::make($arElementIDList);
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
