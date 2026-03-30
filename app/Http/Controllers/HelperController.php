<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
  public function toggleMode(Request $request){
    $x = ($request->mode == '1') ? true : false;
    Auth::user()->update(['dark_mode' => $x]);
  }
}
