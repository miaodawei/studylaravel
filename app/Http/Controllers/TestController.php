<?php

namespace App\Http\Controllers;

use App\Services\Tests\CoroutineTest;
use App\Services\Tests\PromiseTest;
use App\Services\Tests\Test;
use Co\Channel;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Swoole\Coroutine;
use Swoole\Coroutine\WaitGroup;

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
//        $test = new Test();
//        $test->test1();

//        return DB::connection('mysql')->table('erp_user')->where('id', 63913)
//            ->get();
//            ->update(['company_id' => 30]);
    }

    public function testPromise()
    {
        $s = new PromiseTest();
        $s->test();
    }

    public function testRejected()
    {
        $s = new PromiseTest();
        $s->testRejected();
    }

    /**
     * 测试passport授权
     * @return \Illuminate\Http\JsonResponse
     */
    public function testPassPortAuth(Request $request)
    {
        $id = $request->input('id', 0);
        return response()->json($id);
    }

    public function testBlock()
    {
        $start = time();
        $res = [];
        for($i = 1; $i < 4; $i ++) {
            sleep(1);
            $res['data'][] = $i;
        }
        $end = time();
        $res['seconds'] = ($end - $start).'s';
        return response()->json($res);
    }

    public function testCoroutine()
    {
        $start = time();
        $wg = new WaitGroup();
        $res = [];
        for($i = 1; $i < 4; $i ++) {
            $wg->add();
            go(function() use($i, $wg, &$res) {
                Coroutine::sleep(1);
                $res['data'][] = $i;
                $wg->done();
            });
        }
        $wg->wait();
        $end = time();
        $res['seconds'] = ($end - $start).'s';
        return response()->json($res);
    }
}
