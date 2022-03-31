<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementPage;
use Logingrupa\Studybook\Models\Transaction;
use Logingrupa\Studybook\Classes\Item\TransactionItem;

/**
 * Class TransactionPage
 * @package Logingrupa\Studybook\Components
 */
class TransactionPage extends ElementPage
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.transaction_page_name',
            'description' => 'logingrupa.studybook::lang.component.transaction_page_description',
        ];
    }

    /**
     * Get element object
     * @param string $sElementSlug
     * @return Transaction
     */
    protected function getElementObject($sElementSlug)
    {
        if (empty($sElementSlug)) {
            return null;
        }

        $obElement = Transaction::getBySlug($sElementSlug)->first();

        return $obElement;
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @param Transaction $obElement
     * @return TransactionItem
     */
    protected function makeItem($iElementID, $obElement)
    {
        return TransactionItem::make($iElementID, $obElement);
    }
}
