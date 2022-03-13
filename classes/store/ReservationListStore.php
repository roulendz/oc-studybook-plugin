<?php namespace Logingrupa\Studybook\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;
use Logingrupa\Studybook\Classes\Store\Reservation\ActiveListStore;

/**
 * Class ReservationListStore
 * @package Logingrupa\Studybook\Classes\Store
 * @property ActiveListStore  $active
 */
class ReservationListStore extends AbstractListStore
{
    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('active', ActiveListStore::class);
    }
}
