<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    # authrize()メソッドが継承先のコントローラーで使用可能
    use AuthorizesRequests;
}
