<?php namespace Logingrupa\Studybook\Controllers;


use Backend\Classes\Controller;
use Logingrupa\Studybook\Models\Transaction;
use View;

/**
 * Class ProformasController
 * @package Logingrupa\Studybook\Controllers
 */
class ProformasController extends Controller
{
    public function view($slug){
        $transaction = Transaction::whereSlug($slug)->with(['student', 'reservation', 'reservation.course', 'parent', 'parent.children'])->get();
        return View::make('logingrupa.studybook::frontend.proforma', ['transaction' => $transaction]);
    }
}
