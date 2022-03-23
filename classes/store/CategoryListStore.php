<?php namespace Logingrupa\Studybook\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;
use Logingrupa\Studybook\Classes\Store\Category\ActiveListStore;
use Logingrupa\Studybook\Classes\Store\Category\TopLevelListStore;

/**
 * Class CategoryListStore
 * @package Logingrupa\Studybook\Classes\Store
 * @property ActiveListStore  $active
 * @property TopLevelListStore $top_level
 */
class CategoryListStore extends AbstractListStore
{
    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('active', ActiveListStore::class);
        $this->addToStoreList('top_level', TopLevelListStore::class);
    }
}
