<?php namespace Logingrupa\Studybook\Components;

use Lovata\Toolbox\Classes\Component\ElementPage;
use Logingrupa\Studybook\Models\Category;
use Logingrupa\Studybook\Classes\Item\CategoryItem;

/**
 * Class CategoryPage
 * @package Logingrupa\Studybook\Components
 */
class CategoryPage extends ElementPage
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.studybook::lang.component.category_page_name',
            'description' => 'logingrupa.studybook::lang.component.category_page_description',
        ];
    }

    /**
     * Get element object
     * @param string $sElementSlug
     * @return Category
     */
    protected function getElementObject($sElementSlug)
    {
        if (empty($sElementSlug)) {
            return null;
        }

        $obElement = Category::active()->getBySlug($sElementSlug)->first();

        if(!empty($obElement)) {
            $obElement->view_count++;
            $obElement->save();
        }

        return $obElement;
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @param Category $obElement
     * @return CategoryItem
     */
    protected function makeItem($iElementID, $obElement)
    {
        return CategoryItem::make($iElementID, $obElement);
    }
}
