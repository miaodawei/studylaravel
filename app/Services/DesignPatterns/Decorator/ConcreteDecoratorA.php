<?php


namespace App\Services\DesignPatterns\Decorator;


class ConcreteDecoratorA extends Decorator
{
    private $addedState;

    public function operation(): void
    {
        parent::operation();
        $this->addedState = 'New State';
        echo '具体装饰对象A的操作<br>';
    }
}
