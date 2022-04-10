<?php namespace Logingrupa\Studybook;

use Backend\Facades\Backend;
use Event;
use Logingrupa\Studybook\Classes\Event\ExtendBackendMenuHandler;
use System\Classes\PluginBase;

//Event
use Logingrupa\Studybook\Classes\Event\User\UserModelHandler;
use Logingrupa\Studybook\Classes\Event\Course\CourseModelHandler;
use Logingrupa\Studybook\Classes\Event\User\ExtendUserMenuHandler;
use Logingrupa\Studybook\Classes\Event\User\ExtendUserFieldsHandler;
use Logingrupa\Studybook\Classes\Event\Category\CategoryModelHandler;
use Logingrupa\Studybook\Classes\Event\User\ExtendUserControllerHandler;
use Logingrupa\Studybook\Classes\Event\Reservation\ReservationModelHandler;
use Logingrupa\Studybook\Classes\Event\AvailableDate\AvailableDateModelHandler;


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
     * Register columnTypes
     *
     */
    public function registerListColumnTypes()
    {
        return [
            'price' => [$this, 'evalPriceListColumn'],
            'old_price' => [$this, 'evalOldPriceListColumn'],
            'phone_number' => [$this, 'evalPhoneNumberListColumn'],
            'debit_credit_balance' => [$this, 'evalDebitCreditBalanceListColumn'],
        ];
    }

    /**
     * Currency Price Column Type
     */
    public function evalPriceListColumn($value, $column, $record)
    {
        if (is_numeric($value)) {
            if ($value > 0) {
                return '€' . number_format($value / 100, 2, '.', ' ');
            }
            return 'BEZMAKSAS';
        }
        return $value;
    }
    /**
     * Currency Old Price Column Type
     */
    public function evalOldPriceListColumn($value, $column, $record)
    {
        if (is_numeric($value)) {
            if ($value > 0) {
                return '<s>'. '€' . number_format($value / 100, 2, '.', ' '). '<s>';
            }
            return 'BEZMAKSAS';
        }
        return $value;
    }

    /**
     * Currency Old Price Column Type
     */
    public function evalPhoneNumberListColumn($value, $column, $record)
    {
        return '<a href="tel:'. $value .'" >'. $value . '</a>';
    }

    /**
     * Currency Old Price Column Type
     */
    public function evalDebitCreditBalanceListColumn($value, $column, $record)
    {

        if(!$record->children()->count() == 0) {
        $debit = $record->children()->whereActive(true)->sum('debit') / 100;
        $credit = $record->credit / 100;
        return '<p class="positive" style="float:left;width:50%">+€'. $debit . '</p> <p class="negative" style="float:left;width:50%">-€'. ($credit - $debit) . '</p>';
        }
    }

    /**
     * Add event listeners
     */
    protected function addEventListener()
    {
        //User events
        Event::subscribe(UserModelHandler::class);
        Event::subscribe(ExtendUserFieldsHandler::class);
        Event::subscribe(ExtendUserControllerHandler::class);
        Event::subscribe(ExtendUserMenuHandler::class);

        Event::subscribe(ExtendBackendMenuHandler::class);

        Event::subscribe(CourseModelHandler::class);
        Event::subscribe(ReservationModelHandler::class);
        Event::subscribe(CategoryModelHandler::class);
        Event::subscribe(AvailableDateModelHandler::class);
    }
}
