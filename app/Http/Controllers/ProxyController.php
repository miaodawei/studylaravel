<?php

namespace App\Http\Controllers;

use App\Services\Proxy\Proxy;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function proxy()
    {
        $proxy = new Proxy();
        $proxy->request();
    }
}
