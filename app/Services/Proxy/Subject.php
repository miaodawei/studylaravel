<?php


namespace App\Services\Proxy;


abstract class Subject
{
    public abstract function request() : void;
}
