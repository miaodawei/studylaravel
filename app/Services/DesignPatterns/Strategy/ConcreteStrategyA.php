<?php
/**
 * 封装了具体的算法或行为，继承于Strategy
 */

namespace App\Services\DesignPatterns\Strategy;


class ConcreteStrategyA extends Strategy
{

    public function AlgorithmInterface(): void
    {
        echo '算法A实现';
    }
}
