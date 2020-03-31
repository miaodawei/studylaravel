<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use Redis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RedisTestJobQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $redisName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($redisName)
    {
        $this->redisName = $redisName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $r = \Illuminate\Support\Facades\Redis::rPop($this->redisName);
        $r?Log::info('del: '. $r .' is ok'):Log::info('del: '. $r .' is fail');
    }
}
