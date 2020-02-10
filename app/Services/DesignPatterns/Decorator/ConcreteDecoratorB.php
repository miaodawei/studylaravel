<?php


namespace App\Services\DesignPatterns\Decorator;


class ConcreteDecoratorB extends Decorator
{
    public function operation(): void
    {
        parent::operation();
        $this->addedBehavior();
        echo '具体装饰对象B的操作<br>';
    }

    private function addedBehavior() : void
    {

    }
}
