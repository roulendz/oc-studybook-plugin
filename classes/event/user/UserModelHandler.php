<?php namespace Logingrupa\Studybook\Classes\Event\User;

use Logingrupa\Studybook\Models\Transaction;
use RainLab\User\Models\User;
use Logingrupa\Studybook\Models\Reservation;

/**
 * Class UserModelHandler
 * @package Logingrupa\Studybook\Classes\Event\User
 */
class UserModelHandler
{
    /**
     * Add listeners
     */
    public function subscribe()
    {
        $this->extendModel();
    }
    /**
     * Extend product madel
     */
    protected function extendModel()
    {
        User::extend(function ($obModel) {
            /** @var User $obModel */
            $obModel->hasMany['reservations'] = [
                Reservation::class,
                'key'      => 'student_id',
                'order' => 'start_at desc',
            ];
            /** @var User $obModel */
            $obModel->hasMany['transactions'] = [
                Transaction::class,
                'key'      => 'student_id',
                'order' => 'id asc',
                'scope' => 'onlyParents'
            ];
        });
    }
}
