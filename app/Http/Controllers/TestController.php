<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        $a = 1;
        $b = 2;
        return $b;
    }
}
