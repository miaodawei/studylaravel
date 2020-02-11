<?php


namespace App\Services\DesignPatterns\Prototype;


class FooBookPrototype extends BookPrototype
{

    /**
     * @var string
     */
    protected $category = 'Foo';

    /**
     * @return string
     */
    public function getCategory() : string
    {
        return $this->category;
    }

    /**
     * empty clone
     */
    public function __clone()
    {

    }
}
