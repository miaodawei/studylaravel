<?php


namespace App\Services\DesignPatterns\Strategy;


class Context
{
    public $strategy;

    // 初始化时，传入具体的策略对象
    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    // 上下文接口，根据具体的策略对象，调用其算法的方法
    public function contextInterface() : void
    {
        $this->strategy->algorithmInterface();
    }

}
