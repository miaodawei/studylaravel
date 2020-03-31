<?php

namespace App\Http\Controllers;

use App\Jobs\RedisTestJobQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class RedisTestController extends Controller
{
    public $redis_name='testredis';

    public function index()
    {
//        $r = Redis::rPush($this->redis_name, 'sadfsdf');
        $r=Redis::rPush($this->redis_name,Str::random(12));
        echo $r;
    }

    public function getData()
    {
        echo Redis::rPop($this->redis_name);
    }

    public function runJob()
    {
        $job = new RedisTestJobQueue($this->redis_name);
        $this->dispatch($job);
    }
}
