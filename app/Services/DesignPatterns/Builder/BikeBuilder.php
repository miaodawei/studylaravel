<?php


namespace App\Services\DesignPatterns\Builder;


use App\Services\DesignPatterns\Builder\Parts\Engine;
use App\Services\DesignPatterns\Builder\Parts\Vehicle;

/**
 * BikeBuilder用于建造自行车
 */
class BikeBuilder implements BuilderInterface
{
    /**
     * @var Parts\Bike
     */
    protected $bike;

    /**
     * @inheritDoc
     */
    public function createVehicle()
    {
        $this->bike = new Parts\Bike();
    }

    /**
     * @inheritDoc
     */
    public function addWheel()
    {
        $this->bike->setPart('forwardWheel', new Parts\Wheel());
        $this->bike->setPart('rearWheel', new Parts\Wheel());
    }

    /**
     * @inheritDoc
     */
    public function addEngine()
    {
        $this->bike->setPart('engine', new Engine());
    }

    /**
     * @inheritDoc
     */
    public function addDoors()
    {
        // TODO: Implement addDoors() method.
    }

    /**
     * @inheritDoc
     */
    public function getVehicle()
    {
        return $this->bike;
    }
}
