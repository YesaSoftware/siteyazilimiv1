<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLanguage($lang)
    {
        // Seçilen dilin geçerli bir dil olup olmadığını kontrol et
        if (in_array($lang, ['en', 'tr'])) {
            App::setLocale($lang);
            session()->put('locale', $lang);
        } else {
            // Hatalı dil seçimi durumunda bir mesaj ver
            return redirect()->back()->with('error', 'Geçersiz dil seçimi!');
        }

        return redirect()->back();
    }
}
