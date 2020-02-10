<?php


namespace App\Services\DesignPatterns\Decorator;


class Decorator extends Component
{
    protected $component;

    public function setComponent(Component $component) : void
    {
        $this->component = $component;
    }

    public function operation(): void
    {
        if($this->component != null) {
            $this->component->operation();
        }
    }
}
