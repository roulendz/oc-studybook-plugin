<?php namespace Logingrupa\Studybook\Classes\Helper\Reservation;

use Logingrupa\Studybook\Models\AvailableDate;
use Logingrupa\Studybook\Models\Course;

/**
 * Class FormHelper
 * @package Logingrupa\Studybook\Classes\Helper|FormHelper
 * @author Rolands Zeltins, h1@logingrupa.lv, login grupa|
 */
class FormHelper
{

    /**
     * Create Course List Dropdown Options
     * @return array
     */
    public static function staticGetActiveCoursesListOptions($model, $formField): array
    {

        return Course::active()->lists('name', 'id');
    }
    /**
     * Create Course List Dropdown Options
     * @return array
     */
    public static function staticGetSelectedCoursesName($model, $formField): array
    {

        //Check if valid course ID is selected
        if (!$model->course_id) {
            return [];
        }
        // Get Selected Course Available Dates
        $course = (new \Logingrupa\Studybook\Models\Course)->find($model->course_id);
        return [$course->name];
    }
    /**
     * Based on Selected Course ID - Create Course Available Date Dropdwon list
     * @return array
     */
    public static function staticGetAvailableDatesListOptions($model, $formField): array
    {
        //Check if valid course ID is selected
        if (!$model->course_id) {
            return [];
        }
        // Get Selected Course Available Dates
        $availabledates = (new \Logingrupa\Studybook\Models\Course)->find($model->course_id)->availabledates();
        // Create Available Dare List Dropdown Options
        return $availabledates->orderBy('datetime', 'DESC')->lists('datetime', 'datetime');
    }

}
