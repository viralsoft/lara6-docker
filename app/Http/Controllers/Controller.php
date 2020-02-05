<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('check_permission');
        list(, $action) = explode('@', Route::getCurrentRoute()->getActionName());
        $this->middleware(function() use ($action) {
            if (method_exists($this, 'validate_'.$action)) {
                call_user_func(array($this, 'validate_'.$action));
            }
        });

    }
}
