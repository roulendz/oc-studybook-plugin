<?php namespace Logingrupa\Studybook\Components;

use Cms\Classes\ComponentBase;
use Logingrupa\Studybook\Classes\Collection\CourseCollection;

/**
 * Class CourseList
 * @package Logingrupa\Studybook\Components
 */
class CourseList extends ComponentBase
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.course_list_name',
            'description' => 'logingrupa.studybook::lang.component.course_list_description',
        ];
    }

    /**
     * Make element collection
     * @param array $arElementIDList
     * @return CourseCollection
     */
    public function make($arElementIDList = null)
    {
        return CourseCollection::make($arElementIDList);
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
