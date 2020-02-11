<?php


namespace App\Services\DesignPatterns\ChainOfResponsibilities;


class ConcreteHandler2 extends Handler
{
    /**
     * @param int $request
     * @return bool
     */
    public function handleRequest(int $request): bool
    {
        if($request >= 10 && $request < 20) {
            echo 'h2 处理10 到 20<br>';
            return true;
        }elseif(!is_null($this->successor)) {
            $this->successor->handleRequest($request);
        }
        return false;
    }
}
