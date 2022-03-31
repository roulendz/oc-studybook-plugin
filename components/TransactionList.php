<?php namespace Logingrupa\Studybook\Components;

use Cms\Classes\ComponentBase;
use Logingrupa\Studybook\Classes\Collection\TransactionCollection;

/**
 * Class TransactionList
 * @package Logingrupa\Studybook\Components
 */
class TransactionList extends ComponentBase
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.transaction_list_name',
            'description' => 'logingrupa.studybook::lang.component.transaction_list_description',
        ];
    }

    /**
     * Make element collection
     * @param array $arElementIDList
     * @return TransactionCollection
     */
    public function make($arElementIDList = null)
    {
        return TransactionCollection::make($arElementIDList);
    }

    /**
     * Method for ajax request with empty response
     * @return bool
     */
    public function onAjaxRequest()
    {
        return true;
    }
}
