<?php


namespace App\Jobs\Timer;


use App\Tasks\TestTask;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Hhxsv5\LaravelS\Swoole\Timer\CronJob;
use Illuminate\Support\Facades\Log;
use Swoole\Coroutine;

class TestCronJob extends CronJob
{

    protected $i = 0;

    public function interval()
    {
        return 1000; // 每1秒运行1一次
    }

    public function isImmediate()
    {
        return false; // 是否立即执行一次，false则等待间隔时间后执行第一次
    }

    public function run()
    {
        Log::info(__METHOD__, ['start', $this->i, microtime(true)]);
        // sleep(1); // Swoole < 2.1
        Coroutine::sleep(1); // Swoole>=2.1 run()方法已自动创建了协程。
        $this->i ++;
        Log::info(__METHOD__, ['end', $this->i, microtime(true)]);

        if($this->i >= 10) {
            Log::info(__METHOD__, ['stop', $this->i, microtime(true)]);
            $this->stop(); // 终止此任务
            $res = Task::deliver(new TestTask('tesk data'));
            var_dump($res);
        }

    }
}
