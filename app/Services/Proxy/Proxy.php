<?php


namespace App\Services\Proxy;


class Proxy extends Subject
{

    protected $realSubject;

    public function request(): void
    {
        if($this->realSubject == null) {
            $this->realSubject = new RealSubject();
        }
        $this->realSubject->request();
    }
}
