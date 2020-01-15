<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErpUser extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $table = 'erp_user';

    protected $dateFormat = 'U';
}
