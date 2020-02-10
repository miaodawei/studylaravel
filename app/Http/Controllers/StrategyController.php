<?php
/**
 * 策略模式demo
 */

namespace App\Http\Controllers;

use App\Services\DesignPatterns\Strategy\ConcreteStrategyA;
use App\Services\DesignPatterns\Strategy\ConcreteStrategyB;
use App\Services\DesignPatterns\Strategy\ConcreteStrategyC;
use App\Services\DesignPatterns\Strategy\Context;
use Illuminate\Http\Request;

class StrategyController extends Controller
{
    public function strategy()
    {
        $context = new Context(new ConcreteStrategyA());
        $context->contextInterface();

        $context = new Context(new ConcreteStrategyB());
        $context->contextInterface();

        $context = new Context(new ConcreteStrategyC());
        $context->contextInterface();
    }
}
