<?php


namespace App\Proccess;


use App\Tasks\TestTask;
use Hhxsv5\LaravelS\Swoole\Process\CustomProcessInterface;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Log;
use Swoole\Coroutine;
use Swoole\Http\Server;
use Swoole\Process;

class TestProcess implements CustomProcessInterface
{
    /**
     * @var bool 退出标记，用于Reload更新
     */
    private static $quit = false;

    /**
     * @inheritDoc
     */
    public static function callback(Server $swoole, Process $process)
    {
        // 进程运行的代码，不能退出，一旦退出Manager进程会自动再次创建该进程。
//        while(!self::$quit) {
//            Log::info('Test process: running');
//            // sleep(1); // Swoole < 2.1
//            Coroutine::sleep(1); // Swoole>=2.1 已自动为callback()方法创建了协程并启用了协程Runtime。
//            // 自定义进程中也可以投递Task，但不支持Task的finish()回调。
//            // 注意：修改config/laravels.php，配置task_ipc_mode为1或2
//            $ret = Task::deliver(new TestTask('task data1'));
//            var_dump($ret);
//        }

        while ($data = $process->read()) {
            Log::info('TestProcess: read data', [$data]);
            $process->write('TestProcess: ' . $data);
        }
    }

    /**
     * @inheritDoc 要求：LaravelS >= v3.4.0 并且 callback() 必须是异步非阻塞程序。
     */
    public static function onReload(Server $swoole, Process $process)
    {
        // Stop the process...
        // Then end process
        Log::info('Test process: reloading');
        self::$quit = true;
        // $process->exit(0); // 强制退出进程
    }
}
