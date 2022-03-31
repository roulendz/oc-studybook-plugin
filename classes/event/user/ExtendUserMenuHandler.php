<?php namespace Logingrupa\Studybook\Classes\Event\User;

use Backend;
use Lovata\Toolbox\Classes\Event\AbstractBackendMenuHandler;

/**
 * Class ProductControllerHandler
 * @package Logingrupa\Studybook\Classes\Event
 */
class ExtendUserMenuHandler extends AbstractBackendMenuHandler
{
    /** @var int */
    protected $iPriority = 100;

    /**
     * Add/remove menu items
     * @param \Backend\Classes\NavigationManager $obManager
     */
    protected function addMenuItems($obManager)
    {
        $arMenuItemList = [
            'studybook-menu-categories' => [
                'label' => 'logingrupa.studybook::lang.menu.categories',
                'icon'  => 'icon-sitemap',
                'code'  => 'studybook-menu-categories',
                'owner' => 'Logingrupa.Studybook',
                'url'   => Backend::url('logingrupa/studybook/categories'),
            ],
            'studybook-menu-courses' => [
                'label' => 'logingrupa.studybook::lang.menu.courses',
                'icon'  => 'icon-list-ul',
                'code'  => 'studybook-menu-courses',
                'owner' => 'Logingrupa.Studybook',
                'url'   => Backend::url('logingrupa/studybook/courses'),
            ],
            'studybook-menu-reservations' => [
                'label' => 'logingrupa.studybook::lang.menu.reservations',
                'icon'  => 'icon-list',
                'code'  => 'studybook-menu-reservations',
                'owner' => 'Logingrupa.Studybook',
                'url'   => Backend::url('logingrupa/studybook/reservations'),
            ],
            'studybook-menu-availabledates' => [
                'label' => 'logingrupa.studybook::lang.menu.availabledates',
                'icon'  => 'icon-calendar',
                'code'  => 'studybook-menu-availabledates',
                'owner' => 'Logingrupa.Studybook',
                'url'   => Backend::url('logingrupa/studybook/availabledates'),
            ]
        ];

        $obManager->addSideMenuItems('RainLab.User', 'user', $arMenuItemList);
    }

//    /**
//     * Data menu product
//     * @return array
//     */
//    protected function dataMenuProduct()
//    {
//        return [
//            'label'       => 'lovata.shopaholic::lang.menu.products',
//            'url'         => Backend::url('lovata/shopaholic/products'),
//            'icon'        => 'icon-smile-o',
//            'permissions' => ['shopaholic-menu-products'],
//            'order'       => 1000,
//        ];
//    }
}
