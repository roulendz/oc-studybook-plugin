<?php namespace Logingrupa\Studybook\Classes\Helper\Transaction;

use Logingrupa\Studybook\Models\AvailableDate;
use Logingrupa\Studybook\Models\Course;
use Logingrupa\Studybook\Models\Reservation;

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
    public static function staticGetStudentReservationListOptions($model, $formField): array
    {
//        Check if valid course ID is selected
        if (!$model->student_id) {
            return [];
        }
        $obReservations = (new \Logingrupa\Studybook\Models\Reservation())->where('student_id', $model->student_id)->orderBy('start_at', 'desc')->get();
//        return $obReservations;
        $reservations = [];
        foreach ($obReservations as $reservation) {
            $reservations[$reservation->id] = $reservation->start_at . ' - ' . $reservation->name . ' - ' . $reservation->full_name . ' - €' . $reservation->price / 100;
        }
//        dd($reservations);
        return $reservations;
    }
}
