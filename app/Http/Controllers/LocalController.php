<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LocalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function setLocale($lang){

        if (in_array($lang, ['en', 'ar'])) {
            App::setLocale($lang);
            Session::put('locale',$lang);
        }

        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/language.log'),
            'days' => 14,
        ])->info($user . ' Switched the language ' .$lang . ' at' .date('Y-m-d H:i:s'));
        return back();

    }
}
