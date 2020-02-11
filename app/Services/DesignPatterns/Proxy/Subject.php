<?php


namespace App\Services\DesignPatterns\Proxy;


abstract class Subject
{
    public abstract function request() : void;
}
