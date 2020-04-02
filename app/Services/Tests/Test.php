<?php


namespace App\Services\Tests;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Swoole\Coroutine;
use function Co\run;

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
        go(function() use ($n) {
//            echo '  '.json_encode(Coroutine::stats())."\r\n";
            for($i = 0; $i < 10; $i ++) {
                DB::connection('mysql')->table('erp_user')->where('id', 64079)
                    ->increment('company_id');
//                sleep(1);
//                for($j = 0; $j < 5; $j ++) {
//                    echo $n.'  '.Coroutine::getCid()."\r\n";
////                    echo '  '.json_encode(Coroutine::stats())."\r\n";
//                    $n ++;
//                }
            }
        });
        echo ' 出来了... '.Coroutine::exists($cid).'  '.$cid."<br>";
        DB::connection('mysql')->table('erp_user')->where('id', 64079)
            ->update(['company_id' => 30]);
//        echo '  '.json_encode(Coroutine::stats())."<br>";
//        Log::info('aaaa');

//        go(function() {
//            echo '开始...'.date('Ymd H:i:s')."\r\n";
//            sleep(5);
//            echo '醒了...'.date('Ymd H:i:s')."\r\n";
//            echo ' 出来了...'.date('Ymd H:i:s')."\r\n";
//        });

    }
}
