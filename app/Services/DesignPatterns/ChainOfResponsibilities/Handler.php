<?php


namespace App\Services\DesignPatterns\ChainOfResponsibilities;


abstract class Handler
{
    /**
     * @var Handler
     */
    protected $successor;

    /**
     * 设置继任者
     *
     * @param Handler $handler
     */
    final public function setSuccessor(Handler $handler) : void
    {
        $this->successor = $handler;
    }

    /**
     * 处理请求
     *
     * @return bool
     */
    abstract public function handleRequest(int $request) : bool ;
}
