<?php
/**
 * @see https://github.com/hhxsv5/laravel-s/blob/master/Settings-CN.md  Chinese
 * @see https://github.com/hhxsv5/laravel-s/blob/master/Settings.md  English
 */
return [
    'listen_ip'                => env('LARAVELS_LISTEN_IP', '127.0.0.1'),
    'listen_port'              => env('LARAVELS_LISTEN_PORT', 5200),
    'socket_type'              => defined('SWOOLE_SOCK_TCP') ? SWOOLE_SOCK_TCP : 1,
    'enable_coroutine_runtime' => true,
    'server'                   => env('LARAVELS_SERVER', 'LaravelS'),
    'handle_static'            => env('LARAVELS_HANDLE_STATIC', false),
    'laravel_base_path'        => env('LARAVEL_BASE_PATH', base_path()),
    'inotify_reload'           => [
        'enable'        => env('LARAVELS_INOTIFY_RELOAD', false),
        'watch_path'    => base_path(),
        'file_types'    => ['.php'],
        'excluded_dirs' => [],
        'log'           => true,
    ],
    'event_handlers'           => [],
    'websocket'                => [
        'enable' => true,
        'handler' => \App\Services\WebSocketService::class,
        //'handler' => XxxWebSocketHandler::class,
    ],
    'sockets'                  => [],
    'processes'                => [
        'test' => [ // key为进程名
            'class' => \App\Proccess\TestProcess::class,
            'redirect' => false, // 是否重定向输入输出
            'pipe' => 1, // 管道类型：0不创建管道，1创建SOCK_STREAM类型管道，2创建SOCK_DGRAM类型管道
            'enable' => true, // 是否启用，默认true
            //'queue'    => [ // 启用消息队列作为进程间通信，配置空数组表示使用默认参数
            //    'msg_key'  => 0,    // 消息队列的KEY，默认会使用ftok(__FILE__, 1)
            //    'mode'     => 2,    // 通信模式，默认为2，表示争抢模式
            //    'capacity' => 8192, // 单个消息长度，长度受限于操作系统内核参数的限制，默认为8192，最大不超过65536
            //],
        ]
        //[
        //    'class'    => \App\Processes\TestProcess::class,
        //    'redirect' => false, // Whether redirect stdin/stdout, true or false
        //    'pipe'     => 0 // The type of pipeline, 0: no pipeline 1: SOCK_STREAM 2: SOCK_DGRAM
        //    'enable'   => true // Whether to enable, default true
        //],
    ],
    'timer'                    => [
        'enable'        => true,
        'jobs'          => [
//            \App\Jobs\Timer\TestCronJob::class,
            // Enable LaravelScheduleJob to run `php artisan schedule:run` every 1 minute, replace Linux Crontab
            //\Hhxsv5\LaravelS\Illuminate\LaravelScheduleJob::class,
            // Two ways to configure parameters:
            // [\App\Jobs\XxxCronJob::class, [1000, true]], // Pass in parameters when registering
            // \App\Jobs\XxxCronJob::class, // Override the corresponding method to return the configuration
        ],
        'max_wait_time' => 5,
    ],
    'events'                   => [],
    'swoole_tables'            => [],
    'register_providers'       => [],
    'cleaners'                 => [
        \Hhxsv5\LaravelS\Illuminate\Cleaners\AuthCleaner::class
        // If you use the session/authentication/passport in your project
        // Hhxsv5\LaravelS\Illuminate\Cleaners\SessionCleaner::class,
        // Hhxsv5\LaravelS\Illuminate\Cleaners\AuthCleaner::class,

        // If you use the package "tymon/jwt-auth" in your project
        // Hhxsv5\LaravelS\Illuminate\Cleaners\SessionCleaner::class,
        // Hhxsv5\LaravelS\Illuminate\Cleaners\AuthCleaner::class,
        // Hhxsv5\LaravelS\Illuminate\Cleaners\JWTCleaner::class,

        // If you use the package "spatie/laravel-menu" in your project
        // Hhxsv5\LaravelS\Illuminate\Cleaners\MenuCleaner::class,
        // ...
    ],
    'destroy_controllers'      => [
        'enable'        => false,
        'excluded_list' => [
            //\App\Http\Controllers\TestController::class,
        ],
    ],
    'swoole'                   => [
        'daemonize'          => env('LARAVELS_DAEMONIZE', false),
        'dispatch_mode'      => 2,
        'reactor_num'        => env('LARAVELS_REACTOR_NUM', function_exists('swoole_cpu_num') ? swoole_cpu_num() * 2 : 4),
        'worker_num'         => env('LARAVELS_WORKER_NUM', function_exists('swoole_cpu_num') ? swoole_cpu_num() * 2 : 8),
        'task_worker_num'    => env('LARAVELS_TASK_WORKER_NUM', function_exists('swoole_cpu_num') ? swoole_cpu_num() * 2 : 8),
        'task_ipc_mode'      => 1,
        'task_max_request'   => env('LARAVELS_TASK_MAX_REQUEST', 8000),
        'task_tmpdir'        => @is_writable('/dev/shm/') ? '/dev/shm' : '/tmp',
        'max_request'        => env('LARAVELS_MAX_REQUEST', 8000),
        'open_tcp_nodelay'   => true,
        'pid_file'           => storage_path('laravels.pid'),
        'log_file'           => storage_path(sprintf('logs/swoole-%s.log', date('Y-m'))),
        'log_level'          => 4,
        'document_root'      => base_path('public'),
        'buffer_output_size' => 2 * 1024 * 1024,
        'socket_buffer_size' => 128 * 1024 * 1024,
        'package_max_length' => 4 * 1024 * 1024,
        'reload_async'       => true,
        'max_wait_time'      => 10,
        'enable_reuse_port'  => true,
        'enable_coroutine'   => true,
        'http_compression'   => false,

        // Slow log
        // 'request_slowlog_timeout' => 2,
        // 'request_slowlog_file'    => storage_path(sprintf('logs/slow-%s.log', date('Y-m'))),
        // 'trace_event_worker'      => true,

        /**
         * More settings of Swoole
         * @see https://wiki.swoole.com/wiki/page/274.html  Chinese
         * @see https://www.swoole.co.uk/docs/modules/swoole-server/configuration  English
         */
    ],
];
