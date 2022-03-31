<?php namespace Logingrupa\Studybook\Classes\Event\Transaction;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\Studybook\Models\Transaction;
use Logingrupa\Studybook\Classes\Item\TransactionItem;
use Logingrupa\Studybook\Classes\Store\TransactionListStore;

/**
 * Class TransactionModelHandler
 * @package Logingrupa\Studybook\Classes\Event\Transaction
 */
class TransactionModelHandler extends ModelHandler
{
    const EVENT_UPDATE_SORTING = 'studybook.transaction.update.sorting';

    /** @var Transaction */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Transaction::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return TransactionItem::class;
    }

    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);

        $obEvent->listen(self::EVENT_UPDATE_SORTING, function () {
            TransactionListStore::instance()->top_level->clear();

            //Get category ID list
            $arTransactionIDList = Transaction::lists('id');
            if (empty($arTransactionIDList)) {
                return;
            }

            //Clear cache for all
            foreach ($arTransactionIDList as $iTransactionID) {
                TransactionItem::clearCache($iTransactionID);
            }
        });
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
        TransactionListStore::instance()->top_level->clear();
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        TransactionListStore::instance()->top_level->clear();

        //Clear parent item cache
        if (!empty($this->obElement->parent_id)) {
            TransactionItem::clearCache($this->obElement->parent_id);
        }
    }
}
