<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementData;
use Logingrupa\Studybook\Classes\Item\CompanyItem;

/**
 * Class CompanyData
 * @package Logingrupa\Studybook\Components
 */
class CompanyData extends ElementData
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.company_data_name',
            'description' => 'logingrupa.studybook::lang.component.company_data_description',
        ];
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @return CompanyItem
     */
    protected function makeItem($iElementID)
    {
        return CompanyItem::make($iElementID);
    }
}
