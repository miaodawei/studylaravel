<?php

namespace Tests\Unit;

use App\Services\DesignPatterns\Builder\BikeBuilder;
use App\Services\DesignPatterns\Builder\BuilderInterface;
use App\Services\DesignPatterns\Builder\CarBuilder;
use App\Services\DesignPatterns\Builder\Director;
use PHPUnit\Framework\TestCase;

/**
 * DirectorTest 用于测试建造者模式
 */
class DirectorTest extends TestCase
{
    protected $director;

    protected function setUp() : void
    {
        $this->director = new Director();
    }

    public function getBuilder()
    {
        return array(
            array(new CarBuilder()),
            array(new BikeBuilder())
        );
    }

    /**
     * 这里我们测试建造过程，客户端并不知道具体的建造者。
     *
     * @dataProvider getBuilder
     */
    public function testBuild(BuilderInterface $builder)
    {
        $newVehicle = $this->director->build($builder);
        $this->assertInstanceOf('App\Services\DesignPatterns\Builder\Parts\Vehicle', $newVehicle);
    }
}
