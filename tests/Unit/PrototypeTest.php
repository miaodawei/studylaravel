<?php

namespace Tests\Unit;

use App\Services\DesignPatterns\Prototype\BarBookPrototype;
use App\Services\DesignPatterns\Prototype\BookPrototype;
use App\Services\DesignPatterns\Prototype\FooBookPrototype;
use Tests\TestCase;

class PrototypeTest extends TestCase
{
    public function getPrototype()
    {
        return [
            [
                new BarBookPrototype()
            ],
            [
                new FooBookPrototype()
            ]
        ];
    }

    /**
     * @dataProvider getPrototype
     * @param BookPrototype $prototype
     */
    public function testCreation(BookPrototype $prototype)
    {
        $book = clone $prototype;
        $book->setTitle($book->getCategory().' Book');
        $this->assertInstanceOf('App\Services\DesignPatterns\Prototype\BookPrototype', $book);
    }
}
