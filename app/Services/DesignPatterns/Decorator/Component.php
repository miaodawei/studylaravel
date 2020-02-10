<?php
/**
 * 定义一个对象接口，可以给这些对象动态地添加职责
 */

namespace App\Services\DesignPatterns\Decorator;


abstract class Component
{
    public abstract function operation() : void;
}
