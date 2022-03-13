<?php namespace Logingrupa\Studybook\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

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
    ];
    /** @var string */
    public $listConfig = 'config_list.yaml';
    /** @var string */
    public $importExportConfig = 'config_import_export.yaml';
    /** @var string */
    public $formConfig = 'config_form.yaml';

    /**
     * Reservations constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Logingrupa.Studybook', 'studybook-menu-main', 'studybook-menu-reservations');
    }
}
