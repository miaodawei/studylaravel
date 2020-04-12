<?php

namespace App\Http\Controllers;

use App\Services\Tests\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testProcessWrite()
    {
        /**@var \Swoole\Process $process */
        $process = app('swoole')->customProcesses['test'];
        $process->write('TestController: write data' . time());
        $process->write(' #TestController: write data2 ' . microtime(true));
        var_dump($process->read());
    }

    public function testCo()
    {
        $test = new Test();
        return $test->test2();
    }
}
