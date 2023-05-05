<?php namespace Logingrupa\Studybook\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use RainLab\User\Models\User;

/**
 * Class Reservations
 * @package Logingrupa\Studybook\Controllers
 */
class Reservations extends Controller
{
    /** @var array */
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController',
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.RelationController'
    ];
    /** @var string */
    public $listConfig = 'config_list.yaml';
    /** @var string */
    public $importExportConfig = 'config_import_export.yaml';
    /** @var string */
    public $formConfig = 'config_form.yaml';
    /** @var string */
    public $relationConfig = 'config_relation.yaml';

    /**
     * Reservations constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Logingrupa.Studybook', 'studybook-menu-main', 'studybook-menu-reservations');
    }
    public function formExtendModel($model)
    {
//        dd($model);
        /*
         * Init proxy field model if we are creating the model
         * and the context is proxy fields.
         */
        if ($this->formGetContext() === 'create' && !$model->student) {

            $model->student = new User;
        }

        return $model;
    }

    /**
     * Retrieves the price of the reservation with the given reservation ID.
     * If the reservation is not found, it returns a price of 0.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReservationPrice()
    {
        $reservationId = request()->input('reservation_id');
        $reservation = \Logingrupa\Studybook\Models\Reservation::find($reservationId);

        if ($reservation) {
            return response()->json(['price' => $reservation->price]);
        } else {
            return response()->json(['price' => 0]);
        }
    }
}
