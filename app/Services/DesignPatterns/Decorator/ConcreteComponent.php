<?php


namespace App\Services\DesignPatterns\Decorator;


class ConcreteComponent extends Component
{

    public function operation(): void
    {
        echo '具体对象的操作<br>';
    }
}
