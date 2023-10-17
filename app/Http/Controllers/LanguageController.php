<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function change(string $code_iso) {
        session::put('locale', $code_iso);
        App::setLocale($code_iso);

        return back();
    }
}
