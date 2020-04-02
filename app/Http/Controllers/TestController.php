<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testProcessWrite()
    {
        /**@var \Swoole\Process $process */
        $process = app('swoole')->customProcesses['test'];
        $process->write('TestController: write data' . time());
        $process->write(' #TestController: write data2 ' . time());
        var_dump($process->read());
    }
}
