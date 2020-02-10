<?php

namespace App\Http\Controllers;

use App\Services\DesignPatterns\Decorator\ConcreteComponent;
use App\Services\DesignPatterns\Decorator\ConcreteDecoratorA;
use App\Services\DesignPatterns\Decorator\ConcreteDecoratorB;
use Illuminate\Http\Request;

class DecoratorController extends Controller
{
    public function decorator()
    {
        $c = new ConcreteComponent();
        $d1 = new ConcreteDecoratorA();
        $d2 = new ConcreteDecoratorB();

        $d2->setComponent($c);
        $d1->setComponent($d2);
        $d1->operation();
    }
}
