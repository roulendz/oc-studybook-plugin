<?php namespace Logingrupa\Studybook\Controllers;

use Event;
use BackendMenu;
use Backend\Classes\Controller;
use Logingrupa\Studybook\Classes\Event\Transaction\TransactionModelHandler;

/**
 * Class Transactions
 * @package Logingrupa\Studybook\Controllers
 */
class Transactions extends Controller
{
    /** @var array */
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend\Behaviors\ReorderController',
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.RelationController'
    ];
    /** @var string */
    public $listConfig = 'config_list.yaml';
    /** @var string */
    public $reorderConfig = 'config_reorder.yaml';
    /** @var string */
    public $formConfig = 'config_form.yaml';
    /** @var string */
    public $relationConfig = 'config_relation.yaml';

    /**
     * Transactions constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Logingrupa.Studybook', 'studybook-menu-main', 'studybook-menu-transactions');
    }

    /**
     * Ajax handler onReorder event
     */
    public function onReorder()
    {
        $obResult = parent::onReorder();
        Event::fire(TransactionModelHandler::EVENT_UPDATE_SORTING);

        return $obResult;
    }

    /**
     * AvailableDates dynamic row css classes when date is older than today.
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if ($record->active == false) {
            return 'negative';
        }
        if (is_null($record->parent_id)) {
            return 'new';
        }
    }

    public function listOverrideRecordUrl($record, $definition = null)
    {
        if (!is_null($record->parent_id)) {
            return ['clickable' => false];
        }
    }
    public function relationExtendManageWidget($widget, $field, $model)
    {
        // Make sure we are doing on correct relation
        // Also make sure our context is create so we only copy name on create
        if ($field === 'company' && property_exists($widget->config, 'context') && $widget->config->context === 'relation') {
            dd($widget->config->model);
            // This is attendee model
            // This is main tournament model
            $widget->config->model->company = 3;
        }
    }
    // Does not work
    public function onChangeContent()
    {
        // Get reservation ID from request
        $reservation_id = post('Transaction')['reservation_id'];
        $credit = 0;
        // Get reservation ID from request is pressent get reservation price
        if ($reservation_id) {
            // Get the reservation price from the reservation table
            $reservation = \Logingrupa\Studybook\Models\Reservation::find($reservation_id);
            if ($reservation) {
                $credit = $reservation->price;
            }
        }       
        // Get form
        $form = $this->formGetWidget();

        // Get the credit field
        $creditField = $form->getField('credit');
        // Update the model attribute with the credit value
        // TODO: Missing lable after updating value
        $creditField->value = $credit;
        $creditFieldMarkup = $form->renderFieldElement($creditField, [
            'useContainer' => true,
            'useLabel' => true,
            'useComment' => false,
        ]);

        return ['#Form-field-Transaction-credit-group' => $creditFieldMarkup];
    }
}
