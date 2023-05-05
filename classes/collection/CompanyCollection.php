<?php namespace Logingrupa\Studybook\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\Studybook\Classes\Item\CompanyItem;
use Logingrupa\Studybook\Classes\Store\CompanyListStore;

/**
 * Class CompanyCollection
 * @package Logingrupa\Studybook\Classes\Collection
 */
class CompanyCollection extends ElementCollection
{
    const ITEM_CLASS = CompanyItem::class;

    /**
     * Apply filter by active field
     * @return $this
     */
    public function active()
    {
        $arResultIDList = CompanyListStore::instance()->active->get();

        return $this->intersect($arResultIDList);
    }

    /**
     * Get item by code
     * @param string $sCode
     * @return CompanyItem
     */
    public function getByCode($sCode)
    {
        if ($this->isEmpty() || empty($sCode)) {
            return CompanyItem::make(null);
        }

        $arCompanyList = $this->all();

        /** @var CompanyItem $obCompanyItem */
        foreach ($arCompanyList as $obCompanyItem) {
            if ($obCompanyItem->code == $sCode) {
                return $obCompanyItem;
            }
        }

        return CompanyItem::make(null);
    }
}
