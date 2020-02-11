<?php


namespace App\Services\DesignPatterns\Builder;


use App\Services\DesignPatterns\Builder\Parts\Vehicle;

class Director
{
    /**
     * “导演”并不知道具体实现细节
     * @param BuilderInterface $builder
     * @return Vehicle
     */
    public function build(BuilderInterface $builder)
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheel();

        return $builder->getVehicle();
    }
}
