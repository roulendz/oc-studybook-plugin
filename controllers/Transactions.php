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
}
