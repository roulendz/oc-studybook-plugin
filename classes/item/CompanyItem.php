<?php namespace Logingrupa\Studybook\Classes\Item;

use Cms\Classes\Page as CmsPage;

use Lovata\Toolbox\Classes\Item\ElementItem;
use Lovata\Toolbox\Classes\Helper\PageHelper;

use Logingrupa\Studybook\Models\Company;

/**
 * Class CompanyItem
 * @package Logingrupa\Studybook\Classes\Item
 *
 * @property integer $id
 * @property bool $active
 * @property string $name
 * @property string $slug
 * @property string $code
 * @property string $external_id
 * @property string $preview_text
 * @property string $description
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 * @property \System\Models\File $preview_image
 */
class CompanyItem extends ElementItem
{
    const MODEL_CLASS = Company::class;

    /** @var Company */
    protected $obElement = null;

    /**
     * Returns URL of a brand page.
     * @param string $sPageCode
     * @return string
     */
    public function getPageUrl($sPageCode = 'company')
    {
        //Get URL params
        $arParamList = $this->getPageParamList($sPageCode);

        //Generate page URL
        $sURL = CmsPage::url($sPageCode, $arParamList);

        return $sURL;
    }

    /**
     * Get URL param list by page code
     * @param string $sPageCode
     * @return array
     */
    public function getPageParamList($sPageCode) : array
    {
        $arPageParamList = [];

        //Get URL params for page
        $arParamList = PageHelper::instance()->getUrlParamList($sPageCode, 'CompanyPage');
        if (!empty($arParamList)) {
            $sPageParam = array_shift($arParamList);
            $arPageParamList[$sPageParam] = $this->slug;
        }

        return $arPageParamList;
    }
}
