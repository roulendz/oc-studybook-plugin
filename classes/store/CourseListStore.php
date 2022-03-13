<?php namespace Logingrupa\Studybook\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;
use Logingrupa\Studybook\Classes\Store\Course\ActiveListStore;

/**
 * Class CourseListStore
 * @package Logingrupa\Studybook\Classes\Store
 * @property ActiveListStore  $active
 */
class CourseListStore extends AbstractListStore
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
