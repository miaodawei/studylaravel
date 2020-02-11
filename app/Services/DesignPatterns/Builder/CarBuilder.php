<?php


namespace App\Services\DesignPatterns\Builder;


use App\Services\DesignPatterns\Builder\Parts\Door;
use App\Services\DesignPatterns\Builder\Parts\Engine;
use App\Services\DesignPatterns\Builder\Parts\Vehicle;

/**
 * CarBuilder用于建造汽车
 */
class CarBuilder implements BuilderInterface
{

    /**
     * @var Parts\Car
     */
    protected $car;

    /**
     * @return void
     */
    public function createVehicle()
    {
        $this->car = new Parts\Car();
    }

    /**
     * @return void
     */
    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Parts\Wheel());
        $this->car->setPart('wheelRF', new Parts\Wheel());
        $this->car->setPart('wheelLR', new Parts\Wheel());
        $this->car->setPart('wheelRR', new Parts\Wheel());
    }

    /**
     * @return void
     */
    public function addEngine()
    {
        $this->car->setPart('engine', new Engine());
    }

    /**
     * @return void
     */
    public function addDoors()
    {
        $this->car->setPart('rightdoor', new Door());
        $this->car->setPart('leftdoor', new Door());
    }

    /**
     * @return Parts\Car
     */
    public function getVehicle()
    {
        return $this->car;
    }
}
