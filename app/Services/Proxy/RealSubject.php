<?php


namespace App\Services\Proxy;


class RealSubject extends Subject
{

    public function request(): void
    {
        echo '真实的请求<br>';
    }
}
