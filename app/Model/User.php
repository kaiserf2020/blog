<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //1.关联的数据表
    public $table = 'user';

    //2.主键
    public $primaryKey = 'user_id';

    //3.允许批量操作的字段
    //public $fillable = ['username','user_pass','email','phone'];
    public $guarded = [];

    //4.是否维护created_at和 update_at字段
    public $timestamps = false;
}
