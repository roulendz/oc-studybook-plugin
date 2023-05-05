<?php namespace Logingrupa\Studybook\Classes\Event\Company;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\Studybook\Models\Company;
use Logingrupa\Studybook\Classes\Item\CompanyItem;
use Logingrupa\Studybook\Classes\Store\CompanyListStore;

/**
 * Class CompanyModelHandler
 * @package Logingrupa\Studybook\Classes\Event\Company
 */
class CompanyModelHandler extends ModelHandler
{
    /** @var Company */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Company::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return CompanyItem::class;
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

        $this->checkFieldChanges('active', CompanyListStore::instance()->active);
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        if ($this->obElement->active) {
            CompanyListStore::instance()->active->clear();
        }
    }
}
