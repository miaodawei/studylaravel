<?php

namespace App\Http\Controllers;

use App\Services\DesignPatterns\ChainOfResponsibilities\ConcreteHandler1;
use App\Services\DesignPatterns\ChainOfResponsibilities\ConcreteHandler2;
use Illuminate\Http\Request;

class ChainOfREsponsibilitiesController extends Controller
{
    public function handlerRequest()
    {
        $h1 = new ConcreteHandler1();
        $h2 = new ConcreteHandler2();

        $h1->setSuccessor($h2);
        $requests = [2,5,14,22,18,3,27,20];
        foreach($requests as $request) {
            if(!$h1->handleRequest($request)) {
                echo $request.'  无法处理<br>';
            }
        }
    }
}
