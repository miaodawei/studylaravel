<?php


namespace App\Services\DesignPatterns\Prototype;


class BarBookPrototype extends BookPrototype
{

    /**
     * @var string
     */
    protected $category = 'Bar';

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
