<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementData;
use Logingrupa\Studybook\Classes\Item\TransactionItem;

/**
 * Class TransactionData
 * @package Logingrupa\Studybook\Components
 */
class TransactionData extends ElementData
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.transaction_data_name',
            'description' => 'logingrupa.studybook::lang.component.transaction_data_description',
        ];
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @return TransactionItem
     */
    protected function makeItem($iElementID)
    {
        return TransactionItem::make($iElementID);
    }
}
