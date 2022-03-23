<?php namespace Logingrupa\Studybook\Classes\Event\Category;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\Studybook\Models\Category;
use Logingrupa\Studybook\Classes\Item\CategoryItem;
use Logingrupa\Studybook\Classes\Store\CategoryListStore;

/**
 * Class CategoryModelHandler
 * @package Logingrupa\Studybook\Classes\Event\Category
 */
class CategoryModelHandler extends ModelHandler
{
    const EVENT_UPDATE_SORTING = 'studybook.category.update.sorting';

    /** @var Category */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Category::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return CategoryItem::class;
    }

    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);

        $obEvent->listen(self::EVENT_UPDATE_SORTING, function () {
            CategoryListStore::instance()->top_level->clear();

            //Get category ID list
            $arCategoryIDList = Category::lists('id');
            if (empty($arCategoryIDList)) {
                return;
            }

            //Clear cache for all
            foreach ($arCategoryIDList as $iCategoryID) {
                CategoryItem::clearCache($iCategoryID);
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

        $this->checkFieldChanges('active', CategoryListStore::instance()->active);
        CategoryListStore::instance()->top_level->clear();
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        if ($this->obElement->active) {
            CategoryListStore::instance()->active->clear();
        }

        CategoryListStore::instance()->top_level->clear();

        //Clear parent item cache
        if (!empty($this->obElement->parent_id)) {
            CategoryItem::clearCache($this->obElement->parent_id);
        }
    }
}
