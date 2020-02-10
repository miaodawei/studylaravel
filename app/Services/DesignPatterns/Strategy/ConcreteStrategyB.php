<?php


namespace App\Services\DesignPatterns\Strategy;


class ConcreteStrategyB extends Strategy
{

    public function AlgorithmInterface(): void
    {
        echo '算法B实现';
    }
}
