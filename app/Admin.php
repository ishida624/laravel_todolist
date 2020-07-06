<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    public $incrementing = 'false';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =['admin','password','user_info','remember_token'];
}
