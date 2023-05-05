<?php namespace Logingrupa\Studybook\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Class Companies
 * @package Logingrupa\Studybook\Controllers
 */
class Companies extends Controller
{
    /** @var array */
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.FormController',
    ];
    /** @var string */
    public $listConfig = 'config_list.yaml';
    /** @var string */
    public $formConfig = 'config_form.yaml';

    /**
     * Companies constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Logingrupa.Studybook', 'studybook-menu-main', 'studybook-menu-companies');
    }
}
