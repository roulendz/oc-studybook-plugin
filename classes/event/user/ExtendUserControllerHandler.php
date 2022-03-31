<?php namespace Logingrupa\Studybook\Classes\Event\User;

use Lovata\Toolbox\Classes\Event\AbstractExtendRelationConfigHandler;

use RainLab\User\Controllers\Users;

/**
 * Class ExtendProductControllerHandler
 * @package Lovata\LabelsShopaholic\Classes\Event\Product
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class ExtendUserControllerHandler extends AbstractExtendRelationConfigHandler
{
    /**
     * Get path to config file
     * @return string
     */
    protected function getConfigPath() : string
    {
        return '$/logingrupa/studybook/config/user_relation.yaml';
    }

    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass() : string
    {
        return Users::class;
    }
}
