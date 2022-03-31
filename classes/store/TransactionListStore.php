<?php namespace Logingrupa\Studybook\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;
use Logingrupa\Studybook\Classes\Store\Transaction\TopLevelListStore;

/**
 * Class TransactionListStore
 * @package Logingrupa\Studybook\Classes\Store
 * @property TopLevelListStore $top_level
 */
class TransactionListStore extends AbstractListStore
{
    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('top_level', TopLevelListStore::class);
    }
}
