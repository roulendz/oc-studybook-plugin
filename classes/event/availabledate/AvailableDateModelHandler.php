<?php namespace Logingrupa\Studybook\Classes\Event\AvailableDate;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\Studybook\Models\AvailableDate;
use Logingrupa\Studybook\Classes\Item\AvailableDateItem;
use Logingrupa\Studybook\Classes\Store\AvailableDateListStore;

/**
 * Class AvailableDateModelHandler
 * @package Logingrupa\Studybook\Classes\Event\AvailableDate
 */
class AvailableDateModelHandler extends ModelHandler
{
    /** @var AvailableDate */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return AvailableDate::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return AvailableDateItem::class;
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

        $this->checkFieldChanges('active', AvailableDateListStore::instance()->active);
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        if ($this->obElement->active) {
            AvailableDateListStore::instance()->active->clear();
        }
    }
}
