<?php namespace Logingrupa\Studybook\Classes\Event\Reservation;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\Studybook\Models\Reservation;
use Logingrupa\Studybook\Classes\Item\ReservationItem;
use Logingrupa\Studybook\Classes\Store\ReservationListStore;

/**
 * Class ReservationModelHandler
 * @package Logingrupa\Studybook\Classes\Event\Reservation
 */
class ReservationModelHandler extends ModelHandler
{
    /** @var Reservation */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Reservation::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return ReservationItem::class;
    }
    /**
     * After create event handler
     */
    protected function afterCreate()
    {
        parent::afterCreate();
    }

    /**
     * After save event handler
     */
    protected function afterSave()
    {
        parent::afterSave();

        $this->checkFieldChanges('active', ReservationListStore::instance()->active);
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        if ($this->obElement->active) {
            ReservationListStore::instance()->active->clear();
        }
    }
}
