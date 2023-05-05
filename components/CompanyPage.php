<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementPage;
use Logingrupa\Studybook\Models\Company;
use Logingrupa\Studybook\Classes\Item\CompanyItem;

/**
 * Class CompanyPage
 * @package Logingrupa\Studybook\Components
 */
class CompanyPage extends ElementPage
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.company_page_name',
            'description' => 'logingrupa.studybook::lang.component.company_page_description',
        ];
    }

    /**
     * Get element object
     * @param string $sElementSlug
     * @return Company
     */
    protected function getElementObject($sElementSlug)
    {
        if (empty($sElementSlug)) {
            return null;
        }

        $obElement = Company::active()->getBySlug($sElementSlug)->first();

        return $obElement;
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @param Company $obElement
     * @return CompanyItem
     */
    protected function makeItem($iElementID, $obElement)
    {
        return CompanyItem::make($iElementID, $obElement);
    }
}
