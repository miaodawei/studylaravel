<?php


namespace App\Services\DesignPatterns\Builder\Parts;


abstract class Vehicle
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setPart($key, $value)
    {
        $this->data[$key] = $value;
    }
}
