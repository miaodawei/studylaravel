<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Swoole\Coroutine;
use Vtiful\Kernel\Format;
use function Co\run;
use function Psy\debug;

class FileController extends Controller
{
    /**
     * 固定内存模式
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportExcel()
    {
        $startTime = time();
        $config = ['path' => __DIR__.'/../../../storage/'];
        $excel  = new \Vtiful\Kernel\Excel($config);
        $excel->constMemory('test1.xlsx');
        $headers = [];
        for($i = 1; $i < 28; $i ++) {
            $headers[] = 'colume'.$i;
        }
        $filePath = $excel->header($headers);
        $datas = [];
        for($j = 1; $j <= 1000000; $j ++) {
            $row = [];
            for($x = 1; $x < 28; $x ++) {
                $row[] = 'filed'.$x;
            }
            $datas[] = $row;
            if(count($datas) == 10000) {
                $filePath->data($datas);
                $datas = [];
            }
        }

        $filePath->output();
        return response()->json((time() - $startTime).'s');
    }

    /**
     * 普通模式
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportExcel2()
    {
        $startTime = time();
        $headers = [];
        for($i = 1; $i < 28; $i ++) {
            $headers[] = 'colume'.$i;
        }
        $config = ['path' => __DIR__.'/../../../storage/'];
        $excel = new \Vtiful\Kernel\Excel($config);
        $filePath = $excel->fileName('test2.xlsx', 'test')
            ->header($headers);
        $datas = [];
        for($j = 1; $j <= 1000000; $j ++) {
            $row = [];
            for($x = 1; $x < 28; $x ++) {
                $row[] = 'filed'.$x;
            }
            $datas[] = $row;
            if(count($datas) == 10000) {
                $filePath->data($datas);
                $datas = [];
            }
        }
        $filePath->output();
        return response()->json((time() - $startTime).'s');
    }

    /**
     * 协程网络请求数据导出
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportExcel3()
    {
        $startTime = time();
//        $headers = [];
//        for($i = 1; $i < 28; $i ++) {
//            $headers[] = 'colume'.$i;
//        }
//        $config = ['path' => __DIR__.'/../../../storage/'];
//        $excel = new \Vtiful\Kernel\Excel($config);
//        $filePath = $excel->fileName('test3.xlsx', 'test')
//            ->header($headers);
        $wg = new Coroutine\WaitGroup();
        for($i = 1; $i <= 20; $i ++) {
            $wg->add();
            go(function() use(&$filePath, $wg, $i) {
                $cli = new Coroutine\Http\Client('127.0.0.1', 9501);
                $cli->get('/filedata');
                $contents = $cli->body;
                $cli->close();
                $contents = json_decode($contents, true);
                echo Coroutine::getCid().' # '."$i"."完成，请求数据：".count($contents).'条'.PHP_EOL;
//                $filePath->data($contents);
                $wg->done();
            });
        }
        $wg->wait();
//        $filePath->output();
        return response()->json((time() - $startTime).'s');
    }

    /**
     * 非协程网络请求数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportExcel4()
    {
        $startTime = time();
//        $headers = [];
//        for($i = 1; $i < 28; $i ++) {
//            $headers[] = 'colume'.$i;
//        }
//        $config = ['path' => __DIR__.'/../../../storage/'];
//        $excel = new \Vtiful\Kernel\Excel($config);
//        $filePath = $excel->fileName('test4.xlsx', 'test')
//            ->header($headers);
        $http = new Client();
        for($i = 1; $i <= 20; $i ++) {
            $response = $http->request('POST', 'http://127.0.0.1:9501/filedata');
//            $response = $http->request('POST', 'http://alkaid.test/api/filedata');
            $contents = $response->getBody()->getContents();
            $contents = json_decode($contents, true);
            echo Coroutine::getCid()."$i"."完成，请求数据：".count($contents).'条'.PHP_EOL;
//            $filePath->data($contents);
        }
//        $filePath->output();
        return response()->json((time() - $startTime).'s');
    }
}
