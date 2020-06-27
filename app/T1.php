<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T1 extends Model
{
    protected $table = 't1';
    public $incrementing = 'false';
    public $primaryKey = 'no';
    public $timestamps = false;
    protected $fillable =['item','status','update_user'];
}
