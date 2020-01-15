<?php

namespace App\Http\Controllers;

use App\ErpUser;
use App\Events\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ErpUserController extends Controller
{
    public function test()
    {
        $user = ErpUser::findOrFail(63911);
        event(new OrderShipped($user));
        return $user['username'];
//        $sql = 'select * from `erp_user` limit 1';
//        $users = DB::select($sql);
//        return $users;
    }
}
