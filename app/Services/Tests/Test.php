<?php


namespace App\Services\Tests;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Swoole\Coroutine;
use Swoole\Coroutine\WaitGroup;
use Swoole\ExitException;
use function Co\run;
use function foo\func;

class Test
{
    public function test1()
    {
//        unlink('/webserver/davidwww/studylaravel/storage/tmp/text.txt');
//        $i = 0;
//        $file = fopen('/webserver/davidwww/studylaravel/storage/tmp/text.txt', 'a+');
//        for(; $i < 200000; $i ++) {
//            fwrite($file, Coroutine::getCid().'  '.$i.'  '.date('Ymd H:i:s')."\r\n");
//        }
        $n = 0;
        $cid = Coroutine::getCid();
        $chan = new Coroutine\Channel(2);
        go(function() use ($chan, $n) {
            for($i = 0; $i < 5; $i ++) {
                for($j = 0; $j < 5; $j ++) {
                    sleep(1);
//                    echo $n.'  '.Coroutine::getCid()."\r\n";
                    $chan->push($n);
                    $n ++;

                }
            }
        });
        go(function() use ($chan) {
            try {
                while(true) {
                    sleep(1);
                    $nn = $chan->pop();
//                    if(!$nn) {
//                        exit;
//                    }
                    echo Coroutine::getCid().' # '.$nn." @ ".date('Ymd H:i:s')."\r\n";
                }
            }catch (ExitException $e) {
                Log::error('报错了1111：'.$e->getMessage());
            }
        });
//        go(function() use ($chan) {
//            try {
//                while(true) {
//                    sleep(1);
//                    $nn = $chan->pop();
////                    if(!$nn) {
////                        exit;
////                    }
//                    echo Coroutine::getCid().' # '.$nn." @ ".date('Ymd H:i:s')."\r\n";
//                }
//            }catch (ExitException $e) {
//                Log::error('报错了2222：'.$e->getMessage());
//            }
//        });
        echo ' 出来了1111... '.Coroutine::exists($cid).'  '.$cid."<br>";

//        DB::connection('mysql')->table('erp_user')->where('id', 64079)
//            ->update(['company_id' => 30]);
//        echo '  '.json_encode(Coroutine::stats())."<br>";
//        Log::info('aaaa');

//        go(function() {
//            echo '开始...'.date('Ymd H:i:s')."\r\n";
//            sleep(5);
//            echo '醒了...'.date('Ymd H:i:s')."\r\n";
//            echo ' 出来了...'.date('Ymd H:i:s')."\r\n";
//        });

    }

    public function test2()
    {
        $datas = [];
        for($i = 0; $i < 3; $i ++) {
            go(function() use(&$datas,$i) {
                $db = DB::connection('mysql');
                $res = $db->table('posts_two')
                    ->paginate(1);
                $db->disconnect();
                $db->purge();
                $datas[] = $res;
            });
        }
        return response()->json($datas);
    }

    public function testCo($i)
    {
        echo $i.'执行开始'.PHP_EOL;
        sleep(4);
        echo $i.'执行结束'.PHP_EOL;
    }

    public function runCo()
    {
        $startTime = time();

        $start1 = time();
        $this->testCo(1);
        echo ' 调用1用时：'.(time() - $start1).'s'.PHP_EOL;

        $start2 = time();
        $this->testCo(2);
        echo ' 调用2用时：'.(time() - $start2).'s'.PHP_EOL;

        echo '总用时：'.(time() - $startTime).'s'.PHP_EOL;
    }

    public function runCo2()
    {
        go(function() {
            $startTime = time();
            $microtime = $this->msectime();
            go(function() {
                $start1 = time();
                $this->testCo(1);
                echo ' 调用1用时：'.(time() - $start1).'s'.PHP_EOL;
            });
            go(function() {
                $start2 = time();
                $this->testCo(2);
                echo ' 调用2用时：'.(time() - $start2).'s'.PHP_EOL;
            });
            echo '总用时：'.(time() - $startTime).'s'.' # '.($this->msectime() - $microtime).'ms'.PHP_EOL;
        });
        echo 'ok';
    }

    public function testWaitGroup()
    {
        go(function() {
            $wg = new WaitGroup();
            $startTime = time();
            $wg->add();
            go(function() use($wg) {
                $start1 = time();
                $this->testCo(1);
                echo ' 调用1用时：'.(time() - $start1).'s'.PHP_EOL;
                $wg->done();
            });
            $wg->add();
            go(function() use($wg) {
                $start2 = time();
                $this->testCo(2);
                echo ' 调用2用时：'.(time() - $start2).'s'.PHP_EOL;
                $wg->done();
            });
            $wg->wait();
            echo '总用时：'.(time() - $startTime).'s'.PHP_EOL;
        });
    }

    public function msectime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return (float)sprintf('%.0f',(floatval($usec)+floatval($sec))*1000);
//        return ((float)$usec + (float)$sec);
    }
}
