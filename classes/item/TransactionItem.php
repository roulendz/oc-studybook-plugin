<?php namespace Logingrupa\Studybook\Classes\Item;

use Cms\Classes\Page as CmsPage;

use Lovata\Toolbox\Classes\Item\ElementItem;
use Lovata\Toolbox\Classes\Helper\PageHelper;

use Logingrupa\Studybook\Classes\Collection\TransactionCollection;
use Logingrupa\Studybook\Models\Transaction;

/**
 * Class TransactionItem
 * @package Logingrupa\Studybook\Classes\Item
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $code
 * @property string $description
 * @property int $parent_id
 * @property int $nest_left
 * @property int $nest_right
 * @property int $nest_depth
 * @property array $children_id_list
 * @property Transaction $parent
 * @property \October\Rain\Database\Collection|Transaction[] $children
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 */
class TransactionItem extends ElementItem
{
    const MODEL_CLASS = Transaction::class;

    /** @var Transaction */
    protected $obElement = null;
    /** @var array */
    public $arRelationList = [
        'parent'   => [
            'class' => TransactionItem::class,
            'field' => 'parent_id',
        ],
        'children' => [
            'class' => TransactionCollection::class,
            'field' => 'children_id_list',
        ],
    ];

    /**
     * Returns URL of a brand page.
     * @param string $sPageCode
     * @return string
     */
    public function getPageUrl($sPageCode = 'transaction')
    {
        //Get URL params
        $arParamList = $this->getPageParamList($sPageCode);

        //Generate page URL
        $sURL = CmsPage::url($sPageCode, $arParamList);

        return $sURL;
    }

    /**
     * Get URL param list by page code
     * @param string $sPageCode
     * @return array
     */
    public function getPageParamList($sPageCode) : array
    {
        $arPageParamList = [];

        //Get URL params for page
        $arParamList = PageHelper::instance()->getUrlParamList($sPageCode, 'TransactionPage');
        if (!empty($arParamList)) {
            $sPageParam = array_shift($arParamList);
            $arPageParamList[$sPageParam] = $this->slug;
        }

        return $arPageParamList;
    }

    /**
     * Set element data from model object
     * @return array
     */
    protected function getElementData()
    {
        $arResult = [
            'nest_depth' => $this->obElement->getDepth(),
        ];

        $arResult['children_id_list'] = $this->obElement->children()
            ->active()
            ->orderBy('nest_left', 'asc')
            ->lists('id');

        return $arResult;
    }
}
