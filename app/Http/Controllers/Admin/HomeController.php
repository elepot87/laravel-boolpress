<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Mail\SendWelcomeEmail;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    //ADMIN HOMEPAGE CONFIG
    public function index() {

        // Test invio mail - versione statica
        Mail::to('account@mail.com')->send(new SendWelcomeEmail);

        // CARBON
        // $now = new Carbon();

        $now = Carbon::now();

        // dump($now);
        // dump($now -> toDateTimeString());
        // dump($now -> toDateString());


        // data di ieri
        $yesterday = Carbon::yesterday();
        //  dump($yesterday -> toDateTimeString());
        //   dump($yesterday ->format('l d/m/Y'));

        //   data di domani
        $tomorrow = Carbon::tomorrow();
        // dump($tomorrow->format('l d/m/Y'));

        // CREA DATA CARBON (oggetto di data di carbon)
        $expire = Carbon::create('2038/01/19');
        // dump($expire);

        // COMPARAZIONE
        $first = Carbon::create('2021/01/10');
        $second = Carbon::create('2020/01/10');

        // dump($first->lt($second));

        // DIFFERENZE TRA DUE GIORNI
        $date = Carbon::create('2022/02/06');
        // giorni in relazione con oggi
        // dump($date->diffInDays());
        // giorni in relazione a data stabilita
        // dump($date->diffInDays('2022/02/15'));

        // TRADUZIONI
        $dt = Carbon::now();
        // dump($dt->isoFormat('dddd DD/MM/YYYY')); //vedere argomenti di Carbon dentro localization
        // dump($dt->locale());

        return view('admin.home');
    }
}