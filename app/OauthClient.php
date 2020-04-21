<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class OauthClient extends Authenticatable
{

    use HasApiTokens, Notifiable;

    protected $table = 'oauth_clients';
}
