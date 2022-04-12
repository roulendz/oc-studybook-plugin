<?php namespace Logingrupa\Studybook\Classes\Event\User;

use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;
use RainLab\User\Models\User;
use RainLab\User\Controllers\Users;

/**
 * Class ExtendUserFieldsHandler
 * @package Logingrupa\Studybook\Classes\Event\User
 */
class ExtendUserFieldsHandler extends AbstractBackendFieldHandler
{
    /**
     * Extend fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendFields($obWidget)
    {
        $this->removeField($obWidget);
        $this->addField($obWidget);
    }

    /**
     * Remove fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function removeField($obWidget)
    {
        $obWidget->removeField('');
    }

    /**
     * Add fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function addField($obWidget)
    {
        $obWidget->addFields([
            'phone' => [
                'type' => 'text',
                'label' =>  'logingrupa.studybook::lang.field.user.phone',
                'span' => 'left',
//                'tab' => 'rainlab.user::lang.user.account',
            ],
        ]);
        $obWidget->addTabFields([
            'reservations' => [
                'type' => 'partial',
                'path' => '$/logingrupa/studybook/view/_reservations.htm',
                'span' => 'full',
                'tab' => 'logingrupa.studybook::lang.tab.reservations',
                'attributes' => [
                    'tabindex' => 0,
                ],
                'defaultTab' => 'logingrupa.studybook::lang.tab.reservations',
//                'context' => ['update'],
            ],
            'transactions' => [
                'type' => 'partial',
                'path' => '$/logingrupa/studybook/view/_transactions.htm',
                'span' => 'full',
                'tab' => 'logingrupa.studybook::lang.tab.transactions',
                'attributes' => [
                    'tabindex' => 1,
                ],
                'defaultTab' => 'logingrupa.studybook::lang.tab.reservations',
//                'context' => ['update'],
            ],
        ]);
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass() : string
    {
        return User::class;
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
