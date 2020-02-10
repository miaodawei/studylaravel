<?php


namespace App\Services\DesignPatterns\Composite;


use phpDocumentor\Reflection\Types\Integer;

abstract class Component
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public abstract function add(Component $c);
    public abstract function remove(Component $c);
    public abstract function display(int $dept);
}
