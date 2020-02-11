<?php


namespace App\Services\DesignPatterns\ChainOfResponsibilities;


/**
 * 具体处理者类，处理它所负责的请求，可访问它的后继者
 * 如果可处理该请求，就处理之，否则就将该请求转发给它的后继者
 *
 * Class ConcreteHandler1
 * @package App\Services\DesignPatterns\ChainOfResponsibilities
 */
class ConcreteHandler1 extends Handler
{
    /**
     * @param int $request
     * @return bool
     */
    public function handleRequest(int $request): bool
    {
        if($request >= 0 && $request < 10) {
            echo 'h1 处理0 到 10<br>';
            return true;
        }elseif(!is_null($this->successor)) {
            $this->successor->handleRequest($request);
        }
        return false;
    }
}
