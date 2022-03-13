<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementPage;
use Logingrupa\Studybook\Models\Course;
use Logingrupa\Studybook\Classes\Item\CourseItem;

/**
 * Class CoursePage
 * @package Logingrupa\Studybook\Components
 */
class CoursePage extends ElementPage
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.course_page_name',
            'description' => 'logingrupa.studybook::lang.component.course_page_description',
        ];
    }

    /**
     * Get element object
     * @param string $sElementSlug
     * @return Course
     */
    protected function getElementObject($sElementSlug)
    {
        if (empty($sElementSlug)) {
            return null;
        }

        $obElement = Course::active()->getBySlug($sElementSlug)->first();

        if(!empty($obElement)) {
            $obElement->view_count++;
            $obElement->save();
        }

        return $obElement;
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @param Course $obElement
     * @return CourseItem
     */
    protected function makeItem($iElementID, $obElement)
    {
        return CourseItem::make($iElementID, $obElement);
    }
}
