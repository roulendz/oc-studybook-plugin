<?php namespace Logingrupa\Studybook;

use Event;
use System\Classes\PluginBase;

//Event
use Logingrupa\Studybook\Classes\Event\Course\CourseModelHandler;
use Logingrupa\Studybook\Classes\Event\Reservation\ReservationModelHandler;


/**
 * Class Plugin
 * @package Logingrupa\Studybook
 */
class Plugin extends PluginBase
{
    /** @var array Plugin dependencies */
    public $require = ['Lovata.Toolbox'];

    /**
     * Plugin boot method
     */
    public function boot()
    {
        $this->addEventListener();
    }

    /**
     * Add event listeners
     */
    protected function addEventListener()
    {
        Event::subscribe(CourseModelHandler::class);
        Event::subscribe(ReservationModelHandler::class);
    }
}
