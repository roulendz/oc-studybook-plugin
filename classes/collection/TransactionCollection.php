<?php namespace Logingrupa\Studybook\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\Studybook\Classes\Item\TransactionItem;
use Logingrupa\Studybook\Classes\Store\TransactionListStore;

/**
 * Class TransactionCollection
 * @package Logingrupa\Studybook\Classes\Collection
 */
class TransactionCollection extends ElementCollection
{
    const ITEM_CLASS = TransactionItem::class;

    /**
     * Sort list
     * @return $this
     */
    public function tree()
    {
        $arResultIDList = TransactionListStore::instance()->top_level->get();

        return $this->applySorting($arResultIDList);
    }

    /**
     * Get item by code
     * @param string $sCode
     * @return TransactionItem
     */
    public function getByCode($sCode)
    {
        if ($this->isEmpty() || empty($sCode)) {
            return TransactionItem::make(null);
        }

        $arTransactionList = $this->all();

        /** @var TransactionItem $obTransactionItem */
        foreach ($arTransactionList as $obTransactionItem) {
            if ($obTransactionItem->code == $sCode) {
                return $obTransactionItem;
            }
        }

        return TransactionItem::make(null);
    }
}
