<?php


namespace App\Services\Tests;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Swoole\Coroutine;
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
}
