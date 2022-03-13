<?php namespace Logingrupa\Studybook\Classes\Item;

use Cms\Classes\Page as CmsPage;

use Lovata\Toolbox\Classes\Item\ElementItem;
use Lovata\Toolbox\Classes\Helper\PageHelper;

use Logingrupa\Studybook\Models\Course;

/**
 * Class CourseItem
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
 * @property int $view_count
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 * @property \System\Models\File $file
 * @property \System\Models\File $preview_image
 * @property \October\Rain\Database\Collection|\System\Models\File[] $images
 */
class CourseItem extends ElementItem
{
    const MODEL_CLASS = Course::class;

    /** @var Course */
    protected $obElement = null;

    /**
     * Returns URL of a brand page.
     * @param string $sPageCode
     * @return string
     */
    public function getPageUrl($sPageCode = 'course')
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
        $arParamList = PageHelper::instance()->getUrlParamList($sPageCode, 'CoursePage');
        if (!empty($arParamList)) {
            $sPageParam = array_shift($arParamList);
            $arPageParamList[$sPageParam] = $this->slug;
        }

        return $arPageParamList;
    }
}
