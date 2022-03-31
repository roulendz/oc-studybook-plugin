<?php namespace Logingrupa\Studybook\Classes\Event;

use Backend;
use Lovata\Toolbox\Classes\Event\AbstractBackendMenuHandler;

/**
 * Class ProductControllerHandler
 * @package Logingrupa\Studybook\Classes\Event
 */
class ExtendBackendMenuHandler extends AbstractBackendMenuHandler
{
    /** @var int */
    protected $iPriority = 100;

    /**
     * Add/remove menu items
     * @param \Backend\Classes\NavigationManager $obManager
     */
    protected function addMenuItems($obManager)
    {
//        $obManager->removeMainMenuItem('Rainlab.User', 'user');
//        $obManager->removeSideMenuItem('Rainlab.User', 'user', 'users');
        $obManager->addSideMenuItems('Logingrupa.Studybook', 'studybook-menu-main', [
            'studybook-menu-students' => [
                'label' => 'Users',
                'icon'  => 'icon-user',
                'code'  => 'studybook-menu-students',
                'owner' => 'RainLab.User',
                'order' => '1',
                'url'   => Backend::url('rainlab/user/users'),
            ]
        ]);
        $obManager->addSideMenuItems('Logingrupa.Studybook', 'studybook-menu-main', [
            'studybook-menu-student-groups' => [
                'label' => 'Groups',
                'icon'  => 'icon-users',
                'code'  => 'studybook-menu-students',
                'owner' => 'RainLab.User',
                'order' => '2',
                'url'   => Backend::url('rainlab/user/usergroups'),
            ]
        ]);
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
