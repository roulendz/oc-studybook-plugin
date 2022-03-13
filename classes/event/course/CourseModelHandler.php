<?php namespace Logingrupa\Studybook\Classes\Event\Course;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\Studybook\Models\Course;
use Logingrupa\Studybook\Classes\Item\CourseItem;
use Logingrupa\Studybook\Classes\Store\CourseListStore;

/**
 * Class CourseModelHandler
 * @package Logingrupa\Studybook\Classes\Event\Course
 */
class CourseModelHandler extends ModelHandler
{
    /** @var Course */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Course::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return CourseItem::class;
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

        $this->checkFieldChanges('active', CourseListStore::instance()->active);
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        if ($this->obElement->active) {
            CourseListStore::instance()->active->clear();
        }
    }
}
