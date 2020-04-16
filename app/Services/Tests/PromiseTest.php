<?php


namespace App\Services\Tests;


use Hprose\Future;

class PromiseTest
{
    public function test()
    {
        try {
            $promise = new Future(function () {
                return 'hprose';
            });
        } catch (\Exception $e) {
        }
        $promise->then(function($value) {
            var_dump($value);
        });
    }

    public function testRejected()
    {
        try {
            $promise = new Future(function () {
                throw new \Exception('hprose');
            });
            $promise->catchError(function($reason) {
                var_dump($reason);
            });
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
