<?php namespace Logingrupa\Studybook\Controllers;

use Event;
use BackendMenu;
use Backend\Classes\Controller;
use Logingrupa\Studybook\Classes\Event\Category\CategoryModelHandler;

/**
 * Class Categories
 * @package Logingrupa\Studybook\Controllers
 */
class Categories extends Controller
{
    /** @var array */
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend\Behaviors\ReorderController',
        'Backend.Behaviors.FormController',
    ];
    /** @var string */
    public $listConfig = 'config_list.yaml';
    /** @var string */
    public $reorderConfig = 'config_reorder.yaml';
    /** @var string */
    public $formConfig = 'config_form.yaml';

    /**
     * Categories constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Logingrupa.Studybook', 'studybook-menu-main', 'studybook-menu-categories');
    }

    /**
     * Ajax handler onReorder event
     */
    public function onReorder()
    {
        $obResult = parent::onReorder();
        Event::fire(CategoryModelHandler::EVENT_UPDATE_SORTING);

        return $obResult;
    }
}
