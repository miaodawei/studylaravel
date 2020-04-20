<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vtiful\Kernel\Format;

class FileController extends Controller
{
    public function reportExcel()
    {
        $config = ['path' => __DIR__.'/../../../storage/'];
        $excel  = new \Vtiful\Kernel\Excel($config);
        $excel->constMemory('tutorial01.xlsx');
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

        $file = $filePath->output();
        return response()->download($file);
    }
}
