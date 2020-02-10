<?php


namespace App\Services\DesignPatterns\Strategy;


class ConcreteStrategyC extends Strategy
{

    public function AlgorithmInterface(): void
    {
        echo '算法C实现';
    }
}
