<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
   public function logout () {
    //logout user
    auth()->logout();
    // redirect to homepage
    return redirect('/');
}
}
