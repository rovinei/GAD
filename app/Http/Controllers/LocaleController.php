<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use URL;
use Cookie;

class LocaleController extends Controller
{
    public function setLocale($locale = 'en')
    {
        if (! in_array($locale,['kh','en','ch']))
        {
            $locale = 'en';
        }
        Cookie::queue('locale', $locale);
        return redirect(url(URL::previous()));
    }
}
