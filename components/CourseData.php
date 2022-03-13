<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementData;
use Logingrupa\Studybook\Classes\Item\CourseItem;

/**
 * Class CourseData
 * @package Logingrupa\Studybook\Components
 */
class CourseData extends ElementData
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.course_data_name',
            'description' => 'logingrupa.studybook::lang.component.course_data_description',
        ];
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @return CourseItem
     */
    protected function makeItem($iElementID)
    {
        return CourseItem::make($iElementID);
    }
}
